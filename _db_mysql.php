<?php
    ini_set('display_error', 'On');
    global $dbh;
    $dbh = connect();
    function connect()
    {
        // MySQL Hostname / Server (for eg: 'localhost')
            $sql_host = 'localhost';
        $sql_port = '3306';

            // MySQL Database Name
            $sql_name = 'core';

            // MySQL Database User
            $sql_user = 'root';

            // MySQL Database Password
            $sql_pass = '';

        $dbConnect = mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_name, $sql_port);
        mysqli_set_charset($dbConnect, 'utf8');

        return $dbConnect;
    }

    function retrieve($sql)
    {
        $dbConnect = connect();
        if ($dbh === null) {
            return;
        }
        $result = mysqli_query($dbConnect, $sql);
        if ($result !== false) {
            $sql_numrows = mysqli_num_rows($sql);
            if ($sql_numrows > 0) {
                while ($sql_fetch = mysqli_fetch_assoc($sql_query)) {
                    $get[] = $sql_fetch;
                }

                return $get;
            }
        } else {
            $error = 'ไม่สามารถติดต่อกับฐานข้อมูลได้';
            echo $error;
            //pg_close($dbh);
            return;
        }
    }

    function retrieve_params($sql, $arr)
    {
        global $error;
        $dbh = connect();
        if ($dbh === null) {
            return;
        }
        $result = pg_query_params($dbh, $sql, $arr);
        if ($result !== false) {
            $rows = [];
            while ($row = pg_fetch_assoc($result)) {
                $rows[] = $row;
            }
            pg_free_result($result);
            pg_close($dbh);

            return $rows;
        } else {
            $error = 'ไม่สามารถติดต่อกับฐานข้อมูลได้';
            pg_close($dbh);

            return;
        }
    }
