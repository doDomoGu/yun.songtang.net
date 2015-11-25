<?php
namespace app\components;

use app\models\User;
use yii\base\Component;
use app\models\PositionDirPermission;
use yii;

class PermissionFunc extends Component {
    const UPLOAD    = 1;
    const DOWNLOAD  = 2;
    const EDIT      = 3;
    const DELETE    = 4;

    const UPLOAD_COMMON     = 11;
    const DOWNLOAD_COMMON   = 12;
    const EDIT_COMMON       = 13;
    const DELETE_COMMON     = 14;

    const UPLOAD_PERSON     = 21;
    const DOWNLOAD_PERSON   = 22;
    const EDIT_PERSON       = 23;
    const DELETE_PERSON     = 24;

    const UPLOAD_ALL        = 31;
    const DOWNLOAD_ALL      = 32;
    const EDIT_ALL          = 33;
    const DELETE_ALL        = 34;


    /*
     * 权限类型
     * param reverse  键值交换,默认false为 数字对应名称
     * param lang   显示语言 默认为en
     */

    public static function getPermissionTypeArr($reverse=false,$lang='en'){
        if($lang=='cn'){
            $arr = [
                self::UPLOAD_COMMON     =>'上传(公共)',  //普通通用权限
                self::DOWNLOAD_COMMON   =>'下载(公共)',  //下载，查看
                self::EDIT_COMMON       =>'修改(公共)',
                self::DELETE_COMMON     =>'删除(公共)',

                self::UPLOAD_PERSON     =>'上传(个人)',  //限制个人 自己的文件其他人不可见（除拥有最高权限）
                self::DOWNLOAD_PERSON   =>'下载(个人)',
                self::EDIT_PERSON       =>'修改(个人)',
                self::DELETE_PERSON     =>'删除(个人)',

                self::UPLOAD_ALL        =>'上传(最高)',  //最高权限 可看全部，特别是属于个人的文件
                self::DOWNLOAD_ALL      =>'下载(最高)',
                self::EDIT_ALL          =>'修改(最高)',
                self::DELETE_ALL        =>'删除(最高)',
            ];
        }elseif($lang=='cn2'){
            $arr = [
                self::UPLOAD_COMMON     =>'上传<br/>(公共)',  //普通通用权限
                self::DOWNLOAD_COMMON   =>'下载<br/>(公共)',  //下载，查看
                self::EDIT_COMMON       =>'修改<br/>(公共)',
                self::DELETE_COMMON     =>'删除<br/>(公共)',

                self::UPLOAD_PERSON     =>'上传<br/>(个人)',  //限制个人 自己的文件其他人不可见（除拥有最高权限）
                self::DOWNLOAD_PERSON   =>'下载<br/>(个人)',
                self::EDIT_PERSON       =>'修改<br/>(个人)',
                self::DELETE_PERSON     =>'删除<br/>(个人)',

                self::UPLOAD_ALL        =>'上传<br/>(最高)',  //最高权限 可看全部，特别是属于个人的文件
                self::DOWNLOAD_ALL      =>'下载<br/>(最高)',
                self::EDIT_ALL          =>'修改<br/>(最高)',
                self::DELETE_ALL        =>'删除<br/>(最高)',
            ];
        }else{
            $arr = [
                self::UPLOAD_COMMON     =>'upload_common',
                self::DOWNLOAD_COMMON   =>'download_common',
                self::EDIT_COMMON       =>'edit_common',
                self::DELETE_COMMON     =>'delete_common',

                self::UPLOAD_PERSON     =>'upload_person',
                self::DOWNLOAD_PERSON   =>'download_person',
                self::EDIT_PERSON       =>'edit_person',
                self::DELETE_PERSON     =>'delete_person',

                self::UPLOAD_ALL        =>'upload_all',
                self::DOWNLOAD_ALL      =>'download_all',
                self::EDIT_ALL          =>'edit_all',
                self::DELETE_ALL        =>'delete_all',
            ];
        }
        if($reverse){
            $arr = array_flip($arr);
        }
        return $arr;
    }

    public static function getPermissionTypeId($word,$lang='en'){
        $arr = self::getPermissionTypeArr(true,$lang);
        return isset($arr[$word])?$arr[$word]:false;
    }

    public static function getPermissionTypeNameCnByTypeId($type_id){
        $arr = self::getPermissionTypeArr(false,'cn');
        return isset($arr[$type_id])?$arr[$type_id]:false;
    }

    public static function getPermissionTypeNameCn($word){
        $tid = self::getPermissionTypeId($word);
        if($tid){
            $arr2 = self::getPermissionTypeArr(false,'cn');
            return isset($arr2[$tid])?$arr2[$tid]:false;
        }else
            return false;
    }

    public static function getPermissionTypeNameCn2($word){
        $tid = self::getPermissionTypeId($word);
        if($tid){
            $arr2 = self::getPermissionTypeArr(false,'cn2');
            return isset($arr2[$tid])?$arr2[$tid]:false;
        }else
            return false;
    }



    //检测职位对目录的操作权限  *permission_type 操作类 比如 下载 = 1 要判断 文件是否个人的 下载(公共) 下载(个人)
    /*
    * 函数checkPositionDirPermission ,实现根据is_leaf(Dir表 is_leaf字段) 底层
    *
    * @param integer position_id 职位id
    * @param integer file_id 文件id   通过file_id可以知道对应的dir_id和file_permission_type
    * @param integer permission_type 权限类型 [PermissionFunc::DOWNLOAD,PermissionFunc::UPLOAD,PermissionFunc::EDIT,PermissionFunc::DELETE]
    * return array
    */

    public function checkFilePermission($position_id,$file_id,$permission_type){
        if(in_array($permission_type,[PermissionFunc::DOWNLOAD,PermissionFunc::UPLOAD,PermissionFunc::EDIT,PermissionFunc::DELETE])){
            $pm = PositionDirPermission::find()->where(['position_id'=>$position_id,'dir_id'=>$dir_ir])->all();
            if(!empty($pm)){
                //获取拥有的权限数组
                $typeArr = [];
                foreach($pm as $p){
                    $typeArr[] = $p->type;
                }
                //判断下载权限
                if($permission_type==PermissionFunc::DOWNLOAD){

                    if($pm)
                        return true;
                }
            }
        }

        return false;
    }


    public static function checkDirPermission($position_id,$dir_id,$permission_type){
        $pm = PositionDirPermission::find()->where(['position_id'=>$position_id,'dir_id'=>$dir_id])->all();
        if(!empty($pm)){
            //获取拥有的权限数组
            $typeArr = [];
            foreach($pm as $p){
                $typeArr[] = $p->type;
            }

            if(in_array($permission_type,$typeArr)){
                return true;
            }
        }
        return false;
    }

    public static function isAllowUploadCommon($dir_id){
        $position_id = yii::$app->controller->user->position_id;
        $permission_type = self::UPLOAD_COMMON;
        return self::checkDirPermission($position_id,$dir_id,$permission_type);
    }

    public static function checkDirUploadPermission($position_id,$dir_id,$upload_type){
        $pm = PositionDirPermission::find()->where(['position_id'=>$position_id,'dir_id'=>$dir_id])->all();
        if(!empty($pm)){
            //获取拥有的权限数组
            $typeArr = [];
            foreach($pm as $p){
                $typeArr[] = $p->type;
            }

            if(in_array($upload_type,$typeArr)){
                return true;
            }
        }
        return false;
    }

    public static function testShow($position_id,$dir_id){
        $string = null;
        $pm = PositionDirPermission::find()->where(['position_id'=>$position_id,'dir_id'=>$dir_id])->all();
        if(!empty($pm)){
            foreach($pm as $p){

                $string .= $p->type.':'.self::getPermissionTypeNameCnByTypeId($p->type).'<br/>  ';
            }
        }
        return $string;
    }
}