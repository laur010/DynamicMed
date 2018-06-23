<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model
{
  protected $table ='';

  protected $pk = '';

  function __construct()
  {
    parent::__construct();
  }

  function init($table, $pk)
  {
    $this->table = (string)$table;
    $this->pk = (string)$pk;
  }


  function insert($data = null)
  {
    $this->db->insert($this->table, $data);
    return $this->db->insert_id();
  }


  function update($id = null, $data = null)
  {
    $this->db->where("{$this->pk}", $id);
    $this->db->update($this->table, $data);
  }


  function update_where($key = null, $value=null, $data = null)
  {
    $this->db->where($key, $value);
    $this->db->update($this->table, $data);
  }


  function delete($id = null)
  {
    $this->db->where("{$this->pk}", $id);
    return $this->db->delete($this->table);
  }


  function get_where($where = null, $limit = null, $offset = null)
  {
    return $this->db->order_by("{$this->pk}","DESC")->get_where($this->table, $where, $limit, $offset)->result_array();
  }


  function get_where_single($where = null, $limit = null, $offset = null)
  {
    $query = $this->db->get_where($this->table, $where, $limit, $offset);
    if($query->num_rows() != 1)
    {
      return NULL;
    }

    return $query->row();
  }


  function get_where_single_array($where = null, $limit = null, $offset = null)
  {
    $query = $this->db->get_where($this->table, $where, $limit, $offset);
    if($query->num_rows() != 1)
    {
      return NULL;
    }

    return $query->row_array();
  }


  function delete_where($where)
  {
    return $this->db->delete($this->table, $where);
  }


  function get_all()
  {
    $q = $this->db->get($this->table);
    return $q->result();
  }

  function get_all_array()
  {
    $q = $this->db->get($this->table);
    return $q->result_array();
  }


  function get_field($field='*')
  {
    $this->db->select($field);
    $q = $this->db->get($this->table);
    return $q->result_array();
  }


  function get_field_where($field='*', $where)
  {
    $this->db->select($field);
    $this->db->where($where);
    $q = $this->db->get($this->table);
    return $q->result_array();
  }


  function get_limit($limit)
  {
    $this->db->limit($limit);
    $q = $this->db->get($this->table);
    return $q->result_array();
  }


  function get_order_by($field, $order, $limit)
  {
    $this->db->order_by($field, $order);
    if(isset($limit) && $limit >= 0)
    {
      $this->db->limit($limit);
    }
    $q = $this->db->get($this->table);
    return $q->result_array();
  }


  function get_row($id = null)
  {
    $this->db->where("{$this->pk}", $id);
    $q = $this->db->get($this->table);
    return $q->row();
  }


  function get_row_array($id = null)
  {
    $this->db->where("{$this->pk}", $id);
    $q = $this->db->get($this->table);
    return $q->row_array();
  }

  function count_all()
  {
    return (int) $this->db->count_all_results($this->table);
  }

  function count_where($where)
  {
    return (int) $this->db->where($where)->count_all_results($this->table);
  }

  function empty_table()
  {
    $this->db->empty_table($this->table);
  }

  function insert_batch($data)
  {
    $this->db->insert_batch($this->table,$data);
  }
  function exist_item($id){
    return (int)$this->db->where("{$this->pk}", $id)->count_all_results($this->table) == 1;
  }

//  function _do_common_get_grid($params,$page)
//  {
//    if (!empty($params)) {
//
//      if (!empty($params['search'])) {
//
//
//        $this->load->helper('jqgrid_search_operator_match_helper');
//        if (!is_null($params['search']['filters']) && $params['search']['filters'] != '') {
//          try {
//            if (is_array($params['search']['filters'])) {
//              $filters = json_decode(json_encode($params['search']['filters']), FALSE);
//              $rules = json_decode(json_encode($filters->rules), FALSE);
//            } else {
//              $filters = json_decode($params['search']['filters']);
//              $rules = $filters->rules;
//            }
//
//            foreach ($rules as $r) {
//              $op = $r->op;
//              $sql_op = match_operator($op);
//
//              $field = $this->db->escape_str($r->field);
//              $val = $this->db->escape_str($r->data);
//              switch ($op) {
//                case 'bw':
//                case 'ew':
//                case 'cn':
//                  $this->db->like($field, $val, $sql_op);
//                  break;
//                case 'or_cn':
//                  if(trim($val) != "")
//                    $this->db->or_like($field, $val, $sql_op);
//                  break;
//                case 'bn':
//                case 'en':
//                case 'nc':
//                  $this->db->not_like($field, $val, $sql_op);
//                  break;
//                case 'in':
//                  $val = explode(',', $val);
//                  $this->db->where_in($field, $val);
//                  break;
//                case 'ni':
//                  $this->db->where_not_in($field, $val);
//                  break;
//                default:
//                  $this->db->where($field . $sql_op, $val);
//                  break;
//              }
//            }
//          } catch (Exception $e) {
//            return array();
//          }
//        }
//
//        $op = $params['search']['op'];
//        $field = $params['search']['field'];
//        $val = $params['search']['value'];
//        if ($op && $field && $val) {
//          $sql_op = match_operator($op);
//
//          switch ($op) {
//            case 'bw':
//            case 'ew':
//            case 'cn':
//              $this->db->like($field, $val, $sql_op);
//              break;
//            case 'bn':
//            case 'en':
//            case 'nc':
//              $this->db->not_like($field, $val, $sql_op);
//              break;
//            case 'in':
//              $val = explode(',', $val);
//              $this->db->where_in($field, $val);
//              break;
//            case 'ni':
//              $this->db->where_not_in($field, $val);
//              break;
//            default:
//              $this->db->where($field . $sql_op, $val);
//              break;
//          }
//        }
//      }
//
//      $this->db->order_by("{$params['sort_by']}", $params["sort_direction"]);
//
//      if ($page != "all") {
//        $this->db->limit($params["limit"], $params["limit"] * ($params["page"] - 1));
//      }
//    } else {
//      $this->db->limit(5);
//    }
//  }
}

