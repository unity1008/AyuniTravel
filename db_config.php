<?php

$hname='localhost';
$uname='root';
$pass='';
$db='umrah2';


$con= mysqli_connect($hname,$uname,$pass,$db);

if(!$con){
    die("Can not Connect to Database" .mysqli_connect_errno());

}

function filteration($data){
    foreach($data as $key =>$value){
       
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);

       $data[$key] =$value;
    }
    return $data;
}


function selectAll($table){
    $con = $GLOBALS['con'];
    $res = mysqli_query($con,"SELECT * FROM $table") ;
    return $res;
}

function select( $sql,$values,$datatypes){
    $con = $GLOBALS['con'];
    if($stmt=mysqli_prepare($con,$sql)){
        mysqli_stmt_bind_param($stmt,$datatypes,...$values);
        if(mysqli_stmt_execute($stmt)){
            $res= mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        }
        else{
            mysqli_stmt_close($stmt);
            die("Query Can't be executed - Select");
        }
    }
    else{
        die("Query Can't be prepared - Select");
    }   
}


function update( $sql,$values,$datatypes){
    $con = $GLOBALS['con'];
    if($stmt=mysqli_prepare($con,$sql)){
        mysqli_stmt_bind_param($stmt,$datatypes,...$values);
        if(mysqli_stmt_execute($stmt)){
            $res= mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        }
        else{
            mysqli_stmt_close($stmt);
            die("Query Can't be executed - Update");
        }
    }
    else{
        die("Query Can't be prepared - Update");
    }   
}


function insert( $sql,$values,$datatypes){
    $con = $GLOBALS['con'];
    if($stmt=mysqli_prepare($con,$sql)){
        mysqli_stmt_bind_param($stmt,$datatypes,...$values);
        if(mysqli_stmt_execute($stmt)){
            $res= mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        }
        else{
            mysqli_stmt_close($stmt);
            die("Query Can't be executed - Insert");
        }
    }
    else{
        die("Query Can't be prepared - Insert");
    }   
}


function delete( $sql,$values,$datatypes){
    $con = $GLOBALS['con'];
    if($stmt=mysqli_prepare($con,$sql)){
        mysqli_stmt_bind_param($stmt,$datatypes,...$values);
        if(mysqli_stmt_execute($stmt)){
            $res= mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        }
        else{
            mysqli_stmt_close($stmt);
            die("Query Can't be executed - Delete");
        }
    }
    else{
        die("Query Can't be prepared - Delete");
    }   
}
?>