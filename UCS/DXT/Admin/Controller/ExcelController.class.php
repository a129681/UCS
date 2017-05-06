<?php
/**
 * Created by PhpStorm.
 * User: fa
 * Date: 2017/4/4
 * Time: 15:06
 */
namespace Admin\Controller;
use Think\Controller;
class ExcelController extends Controller {


    public function getExcel($name)
    {
        Vendor("PHPExcel.PHPExcel.IOFactory");
        $reader =\ PHPExcel_IOFactory::createReader('Excel2007'); //设置以Excel7格式(Excel97-2003工作簿)
        $PHPExcel = $reader->load("./Data/$name"); // 载入excel文件
        $sheet = $PHPExcel->getSheet(0); // 读取第一個工作表
        $highestRow = $sheet->getHighestRow(); // 取得总行数
        $highestColumm = $sheet->getHighestColumn(); // 取得总列数

        /** 循环读取每个单元格的数据 */
        for ($row = 2; $row <= $highestRow; $row++)//行数是以第1行开始
        {

            for ($column = 'A'; $column <= $highestColumm; $column++) //列数是以A列开始
            {
                $cell=$sheet->getCell($column.$row)->getValue();
                $dataset[$row][$column]=$cell;
            }
        }
        return $dataset;
    }

    public function setJson()
    {
        header("Content-type: text/html; charset=utf-8");
        $res=$this->getExcel('myscore.xlsx');
        $str='';
     for($i=2;$i<count($res);$i++)//处理每一个大学分数线
     {
         $temp='';
        foreach($res[$i] as $key=>$value)
        {
            $sgr='';
            $aeg=preg_replace('/\s+/',' ',$value);
            $arr=explode(' ',$aeg);
            if(!($key=='A'))
            {
                $time="\"$arr[0]\"";
                $Avecore="\"$arr[1]\"";
                $num="\"$arr[2]\"";
                $minscore="\"$arr[3]\"";
                $order="\"$arr[4]\"";
                $sgr=",{time:".$time.",Avecore:".$Avecore.",num:".$num.",minscore:".$minscore.",order:".$order."}";
            }
            $temp=$temp.$sgr;
        }
         $temp=substr($temp,1);
         $name="\"".$res[$i]['A']."\"";
        $str=$str.','.$name.':['.$temp.']';
     }
        $str='var obj={'.substr($str,1);
        echo $str;
        file_put_contents('./Data/data.js',$str,FILE_APPEND);
    }


















    public function aaa()
    {
       $examp=M('Examp');
        $university=M('BaseUniversity');
        $major=M('Major');
        $compare=$examp->field('university,major')->where()->select();

        $union=M('Union');
        for($i=0;$i<count($compare);$i++)
        {
            $un['name']=$compare[$i]['university'];
            $ma['name']=$compare[$i]['major'];
            $uni=$university->where($un)->select();
            $maj=$major->where($ma)->select();
              $map['university_id']=$uni[0]['id'];
              $map['major_id']=$maj[0]['id'];
              $union->data($map)->add();  
        }

    }


    public function union_examp()
    {
        Vendor("PHPExcel.PHPExcel.IOFactory");
        $reader =\ PHPExcel_IOFactory::createReader('Excel2007'); //设置以Excel7格式(Excel97-2003工作簿)
        $PHPExcel = $reader->load("./Data/majorData.xlsx"); // 载入excel文件
        $sheet = $PHPExcel->getSheet(0); // 读取第一個工作表
        $highestRow = $sheet->getHighestRow(); // 取得总行数
        $highestColumm = $sheet->getHighestColumn(); // 取得总列数

        /** 循环读取每个单元格的数据 */
        for ($row = 2; $row <= $highestRow; $row++)//行数是以第1行开始
        {

            for ($column = 'A'; $column <= $highestColumm; $column++) //列数是以A列开始
            {

                if($column=="A"||$column=="C")
                {
                    $cell=$sheet->getCell($column.$row)->getValue();
                    $dataset[$row][$column]=$cell;
                }
            }
        }

//       $str=$dataset[3]['C'];
//        $name=$dataset[3]['A'];
//        $glr=str_replace(' ','',$str);
//
//        $lenArr=explode('个',$glr);
//        echo $lenArr[1].'<br/>';
//        $reg=preg_match_all('/[\x{4e00}-\x{9fa5}]+/u',$glr,$da);
//         $reg=preg_match_all('/■.*/u',$glr,$da);
//         print_r($da);
//        $res=preg_match_all('/■.*■/u',$glr,$ea);
//        $res=preg_match_all('/[\x{4e00}-\x{9fa5}]+/u',$lenArr[1],$ea);
//        print_r($ea);
        function myPreg($str,$name)
        {
            $glr=str_replace(' ','',$str);//去除空格
            $lenArr=explode('个',$glr);//切割字符串
            $union=M('Examp');
            $res=preg_match_all('/■.*/u',$glr,$da);//获取标题;

            for($i=1;$i<count($lenArr);$i++)
            {
                $res=preg_match_all('/[\x{4e00}-\x{9fa5}]+/u',$lenArr[$i],$ea);

                    for($j=0;$j<count($ea[0])-1;$j++)
                    {
                        $map['university']=$name;
                        $map['major']=$ea[0][$j];
                        $map['subject']=$da[0][$i-1];
                        $union->data($map)->add();
                    }

            }

        }
        print_r($dataset[2]['C']);
        for($t=2;$t<count($dataset);$t++)
        {
            myPreg($dataset[$t]['C'],$dataset[$t]['A']);
        }


    }



    public function bce()
    {
        Vendor("PHPExcel.PHPExcel.IOFactory");
        $reader =\ PHPExcel_IOFactory::createReader('Excel2007'); //设置以Excel7格式(Excel97-2003工作簿)
        $PHPExcel = $reader->load("./Data/newMajor.xlsx"); // 载入excel文件
        $sheet = $PHPExcel->getSheet(0); // 读取第一個工作表
        $highestRow = $sheet->getHighestRow(); // 取得总行数
        $highestColumm = $sheet->getHighestColumn(); // 取得总列数

        /** 循环读取每个单元格的数据 */
        for ($row = 2; $row <= $highestRow; $row++)//行数是以第1行开始
        {

            for ($column = 'A'; $column <= $highestColumm; $column++) //列数是以A列开始
            {
                $cell=$sheet->getCell($column.$row)->getValue();
                $dataset[$row][$column]=$cell;
            }
        }
        //print_r($dataset);
        $university=M('Major');
        for($i=2;$i<count($dataset);$i++)
        {
            $map['subject']=$dataset[$i]['A'];
            $map['class']=$dataset[$i]['B'];
            $map['name']=$dataset[$i]['C'];
            $map['cont']=$dataset[$i]['D'];
            $map['re_cont']=$dataset[$i]['E'];
            $university->data($map)->add();
        }


//        $temp[2][0]=$dataset[2]['A'];
//        $f=2;
//        for($t=2;$t<count($dataset);$t++)
//        {
//           for($j=2;$j<count($temp)+2;$j++)
//           {
//                if($temp[$j][0]==$dataset[$t]['A'])
//                {
//                    $flag=0;
//                    for($i=0;$i<count($temp[$j]);$i++)
//                    {
//                        if($temp[$j][$i]==$dataset[$t]['B'])
//                        {
//                            $flag=1;
//                            break;
//                        }
//                        if($i==count($temp[$j])-1)
//                        {
//                            $temp[$j][$i+1]=$dataset[$t]['B'];
//                        }
//                    }
//                    if($flag==1)
//                    {
//                        break;
//                    }
//                }
//                if($j==count($temp)+1)
//                {
//                    $f++;
//                    $temp[$f][0]=$dataset[$t]['A'];
//                }
//           }
//
//        }

//        $class=M('Category');
//
//        for($g=2;$g<count($temp);$g++)
//        {
//           $map['subject']=$temp[$g][0];
//            for($n=1;$n<count($temp[$g]);$n++)
//            {
//                $map['class']=$temp[$g][$n];
//                $class->data($map)->add();
//                print_r($map);
//            }
//        }
    }



    public function dcd()
    {
        $result = M()->table(array('think_major'=>'t1','think_category'=>'t2'))->
        field('t2.id,t1.class,t1.subject')->
        where("t1.class=t2.class AND t1.subject=t2.subject")->select();

//        print_r($result);
        $university=M('Major');
        for($r=0;$r<count($result);$r++)
        {
            $name['class']=$result[$r]['class'];
            $name['subject']=$result[$r]['subject'];
            $map['category_id']=$result[$r]['id'];
            $res=$university->where($name)->save($map);
        }
    }
    public function addddafgaga()
    {
        Vendor("PHPExcel.PHPExcel.IOFactory");
        $reader =\ PHPExcel_IOFactory::createReader('Excel2007'); //设置以Excel7格式(Excel97-2003工作簿)
        $PHPExcel = $reader->load("./Data/linkdata.xlsx"); // 载入excel文件
        $sheet = $PHPExcel->getSheet(0); // 读取第一個工作表
        $highestRow = $sheet->getHighestRow(); // 取得总行数
        $highestColumm = $sheet->getHighestColumn(); // 取得总列数

        /** 循环读取每个单元格的数据 */
        for ($row = 2; $row <= $highestRow; $row++)//行数是以第1行开始
        {

            for ($column = 'A'; $column <= $highestColumm; $column++) //列数是以A列开始
            {
                $cell=$sheet->getCell($column.$row)->getValue();
                $dataset[$row][$column]=$cell;
            }

        }

        $university=M('Example');
        for($i=2;$i<count($dataset);$i++)
        {
            $map['name']=$dataset[$i]['A'];
            $strArr=explode('，',$dataset[$i]['B']);
            $map['province']=$strArr[0];
            $map['city']=$strArr[1];
            $map['web']=$dataset[$i]['C'];
            $map['tuition']=$dataset[$i]['D'];
            $university->data($map)->add();
        }

        $this->display();
    }
    public function web()
    {
        Vendor("PHPExcel.PHPExcel.IOFactory");
        $reader =\ PHPExcel_IOFactory::createReader('Excel2007'); //设置以Excel7格式(Excel97-2003工作簿)
        $PHPExcel = $reader->load("./Data/linkdata.xlsx"); // 载入excel文件
        $sheet = $PHPExcel->getSheet(0); // 读取第一個工作表
        $highestRow = $sheet->getHighestRow(); // 取得总行数
        $highestColumm = $sheet->getHighestColumn(); // 取得总列数

        function tiQuShu($str)
        {
            preg_match('/[0-9]+/',$str,$res);
            if($res)
                return $res[0];
            else
                return 0;
        }
        /** 循环读取每个单元格的数据 */
        for ($row = 2; $row <= $highestRow; $row++)//行数是以第1行开始
        {

            for ($column = 'A'; $column <= $highestColumm; $column++) //列数是以A列开始
            {
                $cell=$sheet->getCell($column.$row)->getValue();
                    if($column=='C'||$column=='F'||$column=='G')
                    {
                        $dataset[$row][$column] = tiQuShu($cell);
                    }else
                    {
                        $dataset[$row][$column]=$cell;
                    }
            }

        }
        $university=M('BaseUniversity');
        for($i=2;$i<count($dataset);$i++)
        {
            $map['name']=$dataset[$i]['A'];
            $map['time']=$dataset[$i]['B'];
            $map['key_disciplines']=$dataset[$i]['C'];
            $map['subjection']=$dataset[$i]['D'];
            $map['type']=$dataset[$i]['E'];
            $map['doctor_station']=$dataset[$i]['F'];
            $map['master_station']=$dataset[$i]['G'];
            $map['people_number']=$dataset[$i]['H'];
            $map['summary']=$dataset[$i]['I'];
            $university->data($map)->add();
        }
        $this->display();

    }
}