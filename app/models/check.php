<?php
class check
{
    private $body;
    private $req = [];
    function check(
        $get = '',
        $post = '',
        $custom = ['body' => 'body', 'value' => 'value']
    ) {
        if ($get) {
            // $this->req = @$_GET[$get];
            $this->body = $get;
            // $this->reqBody[$get] = [];
            $this->req[$get] = ['value' => @$_GET[$get], 'msg' => ''];
            return $this;
        } else if ($post) {
            // $this->req = @$_POST[$post];
            $this->body = $post;
            $this->req[$post] = ['value' => @$_POST[$post], 'msg' => ''];
            return $this;
        } else {
            $this->body = $custom['body'];
            $this->req[$custom['body']] = ['value' => $custom['value'], 'msg' => ''];
            return $this;
        }
    }

    function getValue()
    {
        return $this->req[$this->body]['value'];
    }

    function setValue($value)
    {
        $this->req[$this->body]['value'] = $value;
    }

    function setMsg($er)
    {
        $this->req[$this->body]['msg'] = $er;
    }

    function getBodyError()
    {
        return $this->req[$this->body]['msg'];
    }

    function getError()
    {
        return $this->req;
    }


    function errIsEmpty()
    {
        $bool = false;
        $error = '';
        foreach (self::getError() as $key) {
            $error .= $key['msg'];
        }

        if (empty($error)) {
            $bool = true;
        }

        return $bool;
    }

    function isEmpty()
    {
        if (empty(self::getValue())) {
            return false;
        } else {
            return true;
        }
    }


    function getReq()
    {
        return $this->req;
    }

    function getBodyReq()
    {
        return $this->req[$this->body];
    }



    function isEmail()
    {

        // stroe error
        $error = '';
        self::setValue(trim(filter_var(self::getValue(), FILTER_VALIDATE_EMAIL)));


        //check email not valid
        if (!self::getValue()) {
            $error = "email is not valid";
        } else if (!self::isEmpty()) {
            $error = "invalid value";
        }

        if (!empty($error)) {
            self::setMsg($error);
        }

        return $this;
    }


    function isString()
    {
        self::setValue(trim(filter_var(self::getValue(), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)));
        if (!self::isEmpty()) {
            $error = "invalid value";
        }
        return $this;
    }

    function isLength($ln = ['min' => 8, 'max' => 32], $msg)
    {
        //error store
        $error = '';
        //req value
        $valid = self::getValue();

        //check length
        if ((strlen($valid) > $ln['max']) || (strlen($valid) < $ln['min'])) {
            $error = $msg;
        }


        if (!empty($error)) {
            self::setMsg($error);
        }

        return $this;
    }

    function custom($req2 = '', $callback)
    {
        //error store
        $error = '';
        //value
        $req = self::getValue();
        try {
            $callback($req, $req2, $t = $this);
        } catch (Error $e) {
            $error = $e->getMessage();
            self::setMsg($error);
        }

        return $this;
    }
}