<?php

/**
 * 
 */
include __DIR__ . "/database.php";
class userRepo extends database
{



    function create($record): array
    {
        $id =  $this->model->random(60);
        $activeCode = $this->model->random(60);
        $urlCode = $this->model->random(60);



        $this->query("insert into register(id,name,email,password,activecode,urlcode) values (?,?,?,?,?,?)");
        $this->bind(1, $id);
        $this->bind(2, $record['name']);
        $this->bind(3, $record['email']);
        $this->bind(4, $record['pass']);
        $this->bind(5, $activeCode);
        $this->bind(6, $urlCode);

        $bool = $this->exc();
        if ($bool) {
            return [
                "this" => $this,
                "bool" => true
            ];
        } else {
            return ["bool" => false];
        }
    }



    function update($id, $attrs = [])
    {
        $updateK = $this->model->sqlBind($attrs);
        $sql = "update register set " . $updateK . " where id = ?";
        $this->query($sql);
        $count = 1;
        foreach ($attrs as $value) {
            $this->bind($count, $value);
            $count++;
        }
        $this->bind($count, $id);
        $bool = $this->exc();
        if ($bool) {
            return ['this' => $this, 'id' => $id];
        }
    }

    function delete($id)
    {
        $this->query("delete from register where id = ?");
        $this->bind(1, $id);
        return $this->exc();
    }



    function getAll()
    {
        $this->query("select * from register");
        $this->exc();
        $count = $this->count();
        if ($count == 0) {
            return ['nothing'];
        } else {
            $data = $this->all();
            return ['this' => $this, 'data' => $data, 'count' => $count];
        }
    }


    function getAllLimit($start = 0, $end = 10)
    {
        $this->query("select * from register limit {$start} , {$end}");
        $this->exc();
        $count = $this->count();
        if ($count == 0) {
            return ['nothing'];
        } else {
            $data = $this->all();
            return ['this' => $this, 'data' => $data, 'count' => $count];
        }
    }

    function getOneBy($get): array
    {
        if (isset($get['email'])) {
            $email = $get['email'];
            $this->query("select * from register where email=?");
            $this->bind(1, $email);
            $data = $this->only();
        } else if (isset($get['id'])) {
            $id = $get['id'];
            $this->query("select * from register where id=?");
            $this->bind(1, $id);
            $data = $this->only();
        } else if (isset($get['urlcode'])) {
            $urlcode = $get['urlcode'];
            $this->query("select * from register where urlcode=?");
            $this->bind(1, $urlcode);
            $data = $this->only();
        }

        return ['this' => $this, 'data' => $data];
    }



    //login set information
    function createLogin($i) // create
    {
        $id =  $this->model->random(60);
        $active = $this->model->random(60);
        $data_block = "date_add(now(), interval 1 hour)";

        $this->query("insert into login (id,user, ip,active,date_block) values (?,?,?,?,?)");
        $this->bind(1, $id);
        $this->bind(2, $i);
        $this->bind(3, $this->model->get_client_ip());
        $this->bind(4, $active);
        $this->bind(5, $data_block);
        $bool = $this->exc();

        if ($bool) {
            return ['this' => $this, 'bool' => true];
        } else {
            return false;
        }
    }

    function getOneByLogin($i, $ip)
    {
        $this->query("select * from login where user=? and ip=?");
        $this->bind(1, $i);
        $this->bind(2, $ip);
        $bool = $this->exc();

        if ($bool) {
            return ['this' => $this, 'bool' => true];
        } else {
            return false;
        }
    }

    function updateLogin($i, $ip, $attrs = []) //update login user failed
    {

        $updateK = $this->model->sqlBind($attrs);
        $user = $this->getOneByLogin($i, $ip)['this']->only();
        $data = $this->model->returnData(func_get_args());

        if ($user->failed == 2) {
            $this->query("update login set block = 1, date_block=date_add(now(),interval 1 hour) where user=? and ip=?");
            $this->bind(1, $i);
            $this->bind(2, $ip);
            $bool = $this->exc();
        } else {
            $this->query("update login set failed = ? where user=? and ip=?");
            $this->bind(1, intval($user->failed) + 1);
            $this->bind(2, $i);
            $this->bind(3, $ip);
            $bool = $this->exc();
        }

        return ['this' => $this, 'bool' => true, 'data' => $data];
    }

    function tt()
    {
        return ['this' => $this, 'bool' => true, 'asdfas'];
    }
}