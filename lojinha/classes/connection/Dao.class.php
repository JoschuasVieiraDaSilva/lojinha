<?php

namespace classes\connection;

class Dao {
    private $table = '';
    private $fields = [];
    
    public function insertCmd($values) {
        return 'INSERT INTO ' . $this->getTable() . ' (' . implode(', ', $this->getFields()) . ') VALUES (' . $this->implodeValuesToFields($values) . ')';
    }
    
    public function deleteCmd($field, $value) {
        return 'DELETE FROM ' . $this->getTable() . ' WHERE ' . $field . '=' . (is_numeric($value) ? $value : '"' . $value . '"');
    }
    
    public function selectCmd($filters = []) {
        /* Exemplo de uso:
         * [
         *     'fields': ['id', 'nome'],
         *     'field': 'id',
         *     'value': '32'
         * ];
         **/
        return 'SELECT ' . implode(', ', (isset($filters['fields']) ? $filters['fields'] : $this->getFields())) . ' FROM ' . $this->getTable() . (isset($filters['field']) && isset($filters['value']) ? ' WHERE ' . $filters['field'] . '=' . (is_numeric($filters['value']) ? $filters['value'] : '"' . $filters['value'] . '"') : '');
    }
    
    public function updateCmd($newValues, $field, $value) {
        return 'UPDATE ' . $this->getTable() . ' SET ' . $this->implodeValuesToFields($newValues, $this->getFields()) . ' WHERE ' . $field . '=' . (is_numeric($value) ? $value : '"' . $value . '"');
    }
    
    private function implodeValuesToFields($values, $fields = NULL) {
        $result = '';
        if (is_array($fields)) {
            for ($i = 0; $i < count($values); $i++) {
                $fields[$i] .= '=';
            }
        } else {
            $fields = [];
            for ($i = 0; $i < count($values); $i++) {
                array_push($fields, '');
            }
        }
        for ($i = 0; $i < count($values); $i++) {
            if (is_numeric($values[$i])) {
                $result .= $fields[$i] . $values[$i] . ($i < count($values) - 1 ? ', ' : '');
            } else if ($values[$i] != ''){
                $result .= $fields[$i] . '"' . $values[$i] . ($i < count($values) - 1 ? '", ' : '"');
            } else {
                $result .= $fields[$i] . 'NULL' . ($i < count($values) - 1 ? ', ' : '');
            }
        }
        return $result;
    }

	public function getTable(){
		return $this->table;
	}

	public function setTable($table){
		$this->table = $table;
		return $this;
	}

	public function getFields(){
		return $this->fields;
	}

	public function setFields($fields){
		$this->fields = $fields;
		return $this;
	}
}

?>