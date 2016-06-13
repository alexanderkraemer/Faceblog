<?php

    abstract class Model
    {
        protected static $primarykey;
        protected static $table;

        function __construct ()
        {
            // get child class
            $class = get_called_class ();

            self::$table = $class::$table;
            if ( isset($class::$primaryKey) )
            {
                self::$primarykey = $class::$primaryKey;
            }
        }

        // finds row by id
        public static function find ( $id )
        {
            $class    = get_called_class ();
            $database = new Database();

            $sql  = 'SELECT * FROM ' . $class::$table . ' WHERE 
                    ' . $class::$primaryKey . ' = ?';
            $stmt = $database->conn->prepare ( $sql );
            $stmt->execute ( [ $id ] );

            return $stmt->fetchObject ( $class );
        }

        // either finds row by PK, or return false (detailed query
        public static function findOrFailWhere ( $query = "", $params = [ ] )
        {
            $class    = get_called_class ();
            $database = new Database();

            if ( !empty($query) )
            {
                $query = ' WHERE ' . $query;
            }

            $sql = 'SELECT * FROM ' . $class::$table . $query;

            $count = self::countObjects ( $sql, $params );

            $stmt = $database->conn->prepare ( $sql );
            $stmt->execute ( $params );

            if ( $count === 1 )
            {
                return $stmt->fetchObject ();
            }
            else
            {
                return false;
            }
        }

        // returns all rows of table
        public static function all ()
        {
            $class    = get_called_class ();
            $database = new Database();

            $sql  = 'SELECT * FROM ' . $class::$table;
            $stmt = $database->conn->prepare ( $sql );
            $stmt->execute ();

            return $stmt->fetchAll ( PDO::FETCH_CLASS );
        }

        // fetch first row of select
        public static function first ( $order = '' )
        {
            $class = get_called_class ();
            if ( empty($order) )
            {
                $order = $class::$primaryKey . ' asc ';
            }
            $database = new Database();

            $sql  = 'SELECT * FROM ' . $class::$table . ' ORDER BY ' . $order
                    . ' LIMIT 1';
            $stmt = $database->conn->prepare ( $sql );
            $stmt->execute ();

            return $stmt->fetchAll ( PDO::FETCH_CLASS );
        }

        // create more detailed selects
        public static function where ( $query = "", $params = [ ] )
        {
            $class    = get_called_class ();
            $database = new Database();

            if ( !empty($query) )
            {
                if ( substr ( $query, 0, 5 ) !== 'order' )
                {
                    $query = " WHERE " . $query;
                }
                else
                {
                    $query = " " . $query;
                }
            }


            $sql = 'SELECT * FROM ' . $class::$table . $query;

            $stmt = $database->conn->prepare ( $sql );
            $stmt->execute ( $params );

            return $stmt->fetchAll ( PDO::FETCH_CLASS, $class );
        }

        // create count queries
        public static function countWhere ( $query = "", $params = [ ] )
        {
            $class    = get_called_class ();
            $database = new Database();

            if ( !empty($query) )
            {
                $query = " WHERE " . $query;
            }

            $sql = 'SELECT * FROM ' . $class::$table . $query;

            $stmt = $database->conn->prepare ( $sql );
            $stmt->execute ( $params );

            return count ( $stmt->fetchAll () );
        }

        // save a new instance of the model to the database
        public function save ()
        {
            $database = new Database();
            $class    = get_called_class ();

            $names    = [ ];
            $values   = [ ];
            $varNames = [ ];
            foreach ( get_object_vars ( $this ) as $key => $value )
            {
                $names[]    = $key;
                $values[]   = $value;
                $varNames[] = ':' . $key;
            }

            $preparedSql = 'INSERT INTO ' . $class::$table . ' (' .
                           implode ( ', ', $names ) . ') VALUES ( '
                           . implode ( ', ', $varNames ) . ' )';

            $stmt = $database->conn->prepare ( $preparedSql );

            foreach ( get_object_vars ( $this ) as $key => &$value )
            {
                $stmt->bindParam ( ':' . $key, $value, PDO::PARAM_STR );
            }

            $stmt->execute ();

            return $database->conn->lastInsertId ();
        }

        public function update ()
        {
            $database = new Database();
            $class    = get_called_class ();

            $pk = $class::$primaryKey;

            $names = [ ];

            $keyArr = [ ];
            foreach ( get_object_vars ( $this ) as $key => $value )
            {
                if ( in_array ( $key, $class::$fillable ) )
                {
                    $keyArr[ $key ] = $value;
                }
            }

            foreach ( $keyArr as $key => $value )
            {
                $names[] = $key . ' = :' . $key;
            }
            
            $preparedSql = 'UPDATE ' . $class::$table . ' SET ' .
                           implode ( ', ', $names ) . ' WHERE ' . $pk . ' = :id';

            echo $preparedSql;
            $stmt = $database->conn->prepare ( $preparedSql );

            foreach ( $keyArr as $key => &$value )
            {
                $stmt->bindParam ( ':' . $key, $value, PDO::PARAM_STR );
            }

            $stmt->bindParam ( ':id', $this->$pk, PDO::PARAM_STR );

            $stmt->execute ();
        }

        public function delete ( $where = '', $params = [ ] )
        {
            $database = new Database();
            $class    = get_called_class ();

            if ( !empty($where) )
            {
                $sql  = 'DELETE FROM ' . $class::$table . ' WHERE ' . $where;
                $stmt = $database->conn->prepare ( $sql );
                $stmt->execute ( $params );
            }
            else
            {
                $pk = $class::$primaryKey;

                $sql  =
                    'DELETE FROM ' . $class::$table . ' WHERE ' . $pk . ' =  :id';
                $stmt = $database->conn->prepare ( $sql );
                $stmt->bindParam ( ':id', $this->$pk, PDO::PARAM_INT );
                $stmt->execute ();
            }
        }

        // count the objects of a query
        public static function countObjects ( $query, $params = [ ] )
        {
            $database = new Database();
            $stmt     = $database->conn->prepare ( $query );
            $stmt->execute ( $params );

            return count ( $stmt->fetchAll () );
        }

        // returns number of rows in table
        public static function count ()
        {
            return count ( self::all () );
        }

    }