<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="utf-8" lang="utf-8">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>My Form</title>
    </head>
    <style>

        body {
            width: 35em;
            margin: 0 auto;
            padding: 5px;
            font-family: Tahoma, Verdana, Arial, sans-serif;
        }
        ul
        {
            list-style-type:none;
            margin:0;
            padding:0;
            overflow:hidden;
        }
        li
        {
            float:left;
        }
        a:link,a:visited
        {
            display:block;
            width:120px;
            font-weight:bold;
            color:#FFFFFF;
            background-color:#bebebe;
            text-align:center;
            padding:4px;
            text-decoration:none;
            text-transform:uppercase;
        }
        a:hover,a:active
        {
            background-color:#cc0000;
        }

    </style>
    <body>
        <ul>
            <li><a href = "http://localhost/index.php/form/home" class="button" >Home</a></li>
            <li><a href = "http://localhost/index.php/form/contact">Contact</a></li>
            <li><a href = "http://localhost/index.php/form/about">About</a></li>
            <li><a href = "http://localhost/index.php/form/register">Register</a></li>
            <li><a href = "http://localhost/index.php/form/login">Login</a></li>

        </ul>
        <?php echo validation_errors(); ?>

        <?php echo form_open('form/login'); ?>

        <h5>Phone</h5>
        <?php echo form_error('user_id'); ?>
        <input type="text" name="user_id" value="<?php echo set_value('user_id'); ?>" size="50" />

        <h5>Password</h5>
        <?php echo form_error('passwd'); ?>
        <input type="text" name="passwd" value="<?php echo set_value('passwd'); ?>" size="50" />

        <div><input type="submit" value='submit' /></div>

        </form>

    </body>
</html>