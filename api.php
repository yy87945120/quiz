<?php

function read_csv($file)
{
    setlocale(LC_ALL,'zh_CN');//linux系统下生效
    $data = null;//返回的文件数据行
    if(!is_file($file)&&!file_exists($file))
    {
        die('文件错误');
    }
    $cvs_file = fopen($file,'r'); //开始读取csv文件数据
    $i = 0;//记录cvs的行
    while ($file_data = fgetcsv($cvs_file))
    {
        $i++;
        if($i==1)
        {
            continue;//过滤表头
        }
        if($file_data[0]!='')
        {
            $data[$i] = $file_data;
        }
 
    }
    fclose($cvs_file);
    return $data;
}


function createcsv($csv_body)
{
    // 头部标题
    $csv_header = array('sku','我们自己的成本价','京东自己的销售价','对比结果');
 
    /**
     * 开始生成
     * 1. 首先将数组拆分成以逗号（注意需要英文）分割的字符串
     * 2. 然后加上每行的换行符号，这里建议直接使用PHP的预定义
     * 常量PHP_EOL
     * 3. 最后写入文件
     */
// 打开文件资源，不存在则创建
    $des_file = 'd:/res.csv';
    $fp = fopen(    $des_file,'a');
// 处理头部标题
    $header = implode(',', $csv_header) . PHP_EOL;
// 处理内容
    $content = '';
    foreach ($csv_body as $k => $v) {
        $content .= implode(',', $v) . PHP_EOL;
    }
// 拼接
    $csv = $header.$content;
// 写入并关闭资源
    fwrite($fp, $csv);
    fclose($fp);
}

    $res = [];    
    
    if(isset($_REQUEST)){
        if(isset($_REQUEST['data'])){
            $data = xss(json_decode($_REQUEST['data'],1));
        }
        
        $action = $_REQUEST['action'];
        
        $res = call_user_func($action,$data,$db);
    }else{
        
        $res['state'] = '-1';
        $res['data'] = 'params required';
        
    }
    
    echo json_encode($res);
?>