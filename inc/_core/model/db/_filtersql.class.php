<?php
/**
 * This file implements the FilterSQL class.
 *
 * This file is part of the evoCore framework - {@link http://evocore.net/}
 * See also {@link https://github.com/b2evolution/b2evolution}.
 *
 * @license GNU GPL v2 - {@link http://b2evolution.net/about/gnu-gpl-license}
 *
 * @copyright (c)2003-2018 by Francois Planque - {@link http://fplanque.com/}
 *
 * @package evocore
 */
if( !defined('EVO_MAIN_INIT') ) die( 'Please, do not access this page directly.' );


load_class( '_core/model/db/_sql.class.php', 'SQL' );

/**
 * FilterSQL class: help constructing queries for filtering lists.
 */
class FilterSQL extends SQL
{
	/**
	 * Array with joined tables,
	 * Used to don't join same table twice in order to avoid error "Not unique table/alias"
	 */
	var $joined_tables = array();


	/**
	 * Constructor.
	 */
	function __construct( $title = NULL )
	{
		parent::__construct( $title );
	}


	/**
	 * Extends the FROM clause.
	 *
	 * @param string should typically start with INNER JOIN or LEFT JOIN
	 */
	function FROM_add( $from_add )
	{
		if( preg_match( '#JOIN (T_.+) ON#', $from_add, $m ) )
		{	// If some table is joined
			if( in_array( $m[1], $this->joined_tables ) )
			{	// Skip this table joining because it was already done before:
				return;
			}
			// Store the joined table in this array to don't join it twice:
			$this->joined_tables[] = $m[1];
		}

		parent::FROM_add( $from_add );
	}


	/**
	 * Restrict by query
	 *
	 * @param string Query in JSON format
	 */
	function filter_query( $query )
	{
		$json_query = json_decode( $query );

		if( $json_query === NULL || ! isset( $json_query->valid ) || $json_query->valid !== true )
		{	// Wrong query, Stop here:
			return;
		}

		// Get SQL conditions from JSON query object:
		$sql_conditions = $this->get_filter_conditions( $json_query );

		if( ! empty( $sql_conditions ) )
		{	// Use only not empty conditions:
			$this->WHERE_and( $sql_conditions );
		}
	}


	/**
	 * Get filter conditions
	 *
	 * @param object Query in JSON format
	 * @return string
	 */
	function get_filter_conditions( $query )
	{
		if( ! isset( $query->condition, $query->rules ) ||
		    ! in_array( $query->condition, array( 'AND', 'OR' ) ) ||
		    empty( $query->rules ) )
		{	// Wrong json query params, Skip it:
			return;
		}

		$sql_conditions = array();
		foreach( $query->rules as $r => $rule )
		{
			if( isset( $rule->rules ) && is_array( $rule->rules ) )
			{	// This is a group of conditions, Run this function recursively:
				$sql_condition = $this->get_filter_conditions( $rule );
				if( ! empty( $sql_condition ) )
				{	// Use only correct conditions:
					$sql_conditions[] = '( '.$sql_condition.' )';
				}
			}
			else
			{	// This is a single condition:
				if( ! isset( $rule->field, $rule->value, $rule->operator ) ||
				    ! method_exists( $this, 'filter_field_'.$rule->field ) )
				{	// Skip it if wrong rule or method doesn't exist for filterting by the rule field:
					continue;
				}
				$sql_condition = $this->{'filter_field_'.$rule->id}( $rule->value, $rule->operator );
				if( ! empty( $sql_condition ) )
				{	// Use only correct conditions:
					$sql_conditions[] = $sql_condition;
				}
			}
		}

		return empty( $sql_conditions ) ? '' : implode( ' '.$query->condition.' ', $sql_conditions );
	}


	/**
	 * Get SQL condition for "WHERE" clause
	 *
	 * @param string Field name in DB
	 * @param string Value
	 * @param string Operator in format of jQuery plugin QueryBuilder
	 * @return string
	 */
	function get_where_condition( $field_name, $value, $operator )
	{
		global $DB;

		$value_prefix = '';
		$value_suffix = '';

		switch( $operator )
		{
			case 'equal':
				$sql_operator = '=';
				break;
			case 'not_equal':
				$sql_operator = '!=';
				break;
			case 'less':
				$sql_operator = '<';
				break;
			case 'less_or_equal':
				$sql_operator = '<=';
				break;
			case 'greater':
				$sql_operator = '>';
				break;
			case 'greater_or_equal':
				$sql_operator = '>=';
				break;
			case 'between':
				$sql_operator = array( 'BETWEEN', 'AND' );
				break;
			case 'not_between':
				$sql_operator = array( 'NOT BETWEEN', 'AND' );
				break;
			case 'contains':
				$sql_operator = 'LIKE';
				$value_prefix = '%';
				$value_suffix = '%';
				break;
			case 'not_contains':
				$sql_operator = 'NOT LIKE';
				$value_prefix = '%';
				$value_suffix = '%';
				break;
			default:
				debug_die( 'Unknown filter condition operator "'.$operator.'" for the field "'.$field_name.'"' );
		}

		// Build SQL condition from given operator and value:
		$sql_where_condition = $field_name;
		if( is_array( $sql_operator ) )
		{	// Multiple operators and values:
			foreach( $sql_operator as $i => $sql_operator_item )
			{
				$sql_where_condition .= ' '.$sql_operator_item.' '.$DB->quote( $value_prefix.$value[ $i ].$value_suffix );
			}
		}
		else
		{	// Single operator and value:
			$sql_where_condition .= ' '.$sql_operator.' '.$DB->quote( $value_prefix.$value.$value_suffix );
		}

		return $sql_where_condition;
	}
}
?>