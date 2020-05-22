<?php
function find($table,$id){
    global $pdo;
    if(is_array($id)){
        $temp=[];
        foreach($id as $key => $value){
            $temp[]=sprintf("`%s`='%s'",$key,$value);
        }
        $sql="select * from $table where " . join(" && ",$temp);
    }else{
        $sql="select * from $table where `id`='$id'";
    }
    $r=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    return $r;
}
function save($table,$arg){
    global $pdo;
    if(isset($arg['id'])){
        foreach ($arg as $key => $value) {
            if($key!='id'){
                $tmp[]=sprintf("`%s`='%s'",$key,$value);
            }
        }
        $sql="update $table set " . join(',',$tmp) . " where `id`='".$arg['id']."'";
    }else{
        $sql="insert into " . $table . "(`" . join("`,`",array_keys($arg)) . "`)" . " values " . "('" . join("','",$arg) . "')";
    }
    return $pdo->exec($sql);
}
function q($sql){
    global $pdo;
    return $pdo->query($sql)->fetchAll();
}
function nums($table,...$b){
    global $pdo;
    $sql="select count(*) from $table";
    if(isset($b[0]) && is_array($b[0])){
        $tmp=[];
        foreach($b[0] as $key => $balue){
            $tmp[]=sprintf("`%s` = '%s'",$key,$balue);         
        }
        $sql = $sql . " where " . join(" && ", $tmp);
    }
    if(isset($b[1])){
        $sql = $sql . $v[1];
    }
    echo $sql . "<br>";
    echo $pdo->query($sql)->fetchcolumn() . "<hr>";
}
function del($table,$b){
    global $pdo;
    $sql="delete from $table";
    if(is_array($b)){
        $q=[];
        foreach ($b as $key => $value) {
            $q[]=sprintf("`%s`='%s'",$key,$value);
        }
        $sql=$sql . " where " . join(" && ",$q);
    }else{
        $sql=$sql . " where `id` =" . "'" . $b . "'";
    }
    return $pdo->exec($sql);
}
function all($table,...$v){
    global $pdo;
    $sql="select * from $table ";
    if(isset($v[0]) && is_array($v[0])){
        $tmp=[];
        foreach($v[0] as $key => $value){
            $tmp[]=sprintf("`%s` = '%s'",$key,$value);
        }
        $sql = $sql . " where " . join(" && ", $tmp);
    }
    if(isset($v[1])){
        $sql = $sql . $v[1];
    }
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
function to ($ual){
    header("location:" . $ual);
}
?>