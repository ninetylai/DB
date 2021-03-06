<?php
    spl_autoload_register(function($className){
        $dirName = dirname($className).DIRECTORY_SEPARATOR;
        $className = basename($className);
        $path = str_replace('\\', '/', realpath($dirName.$className.'.php'));
        if(file_exists($path))
        {
            require_once($path);
        }else{
            die('file not found'. $path);
        }
    });

try
{
    $db = new Lib\DB\DB('localhost', 'root', '', 'article');
   $result = $db->query(
       "SELECT * FROM tb_article_detail WHERE aid = ?",
       [
           'types'=>'i',
           'bindParams'=>[
               'aid'=>1106
           ]
       ]
   );
    $affected = $db->execute('INSERT INTO tb_article_tag_name(`name`,weight,base) VALUES(?,?,?)',
        [
            'types'=>'sii',
            'bindParams'=>[
                'name'=>'66779988',
                'weight'=>100,
                'base'=>0
            ]
        ]
    );
    echo $affected;
    echo '<br />';
    echo $db->getInsertId();

}
catch(Exceptions\DB\ConnectFail $e)
{
    echo $e->getMessage();
}
catch(Exceptions\DB\SQLException $e)
{
    echo $e->getMessage();
    echo '<br />';
    echo $e->getSql();
}
catch(\Exception $e)
{
    echo $e->getMessage();
}
