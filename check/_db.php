<?php
    include '../_db.php';
/*
    global $dbh;
    $dbh = connect();
    function connect() {
        global $error;
        $h = pg_connect('host=localhost port=5432 dbname=samuiaksorn2012 user=postgres password=postgres');
        if ($h === false) {
            $error = 'มีปัญหาในการเชื่อมต่อกับฐานข้อมูล';
            return null;
        }
        return $h;
    }

    function retrieve($sql) {
        global $error;
        $dbh = connect();
        if ($dbh === null) {
            return null;
        }
        $result = pg_query($sql);
        if ($result !== false) {
            $rows = array();
            while($row = pg_fetch_assoc($result)) {
                $rows[] = $row;
            }
            pg_free_result($result);
            pg_close($dbh);
            return $rows;
        }
        else {
            $error = 'ไม่สามารถติดต่อกับฐานข้อมูลได้';
            pg_close($dbh);
            return null;
        }
    }


    function retrieve_params($sql, $arr) {
        global $error;
        $dbh = connect();
        if ($dbh === null) {
            return null;
        }
        $result = pg_query_params($dbh, $sql, $arr);
        if ($result !== false) {
            $rows = array();
            while($row = pg_fetch_assoc($result)) {
                $rows[] = $row;
            }
            pg_free_result($result);
            pg_close($dbh);
            return $rows;
        }
        else {
            $error = 'ไม่สามารถติดต่อกับฐานข้อมูลได้';
            pg_close($dbh);
            return null;
        }
    }
    */;
