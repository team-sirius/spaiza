<?php

/**
 * Description of Files
 *
 * @author Saad
 */
class Files{
    

    static function add(\Main $b, string $path, string $ext, string $mime, ?string &$err): int {
        if(!file_exists(ROOT."/".$path)){
            $err = lnTranslate("This file does not exist..");
            return 0;
        }
        $q = "INSERT INTO `files`(url, mime, ext) VALUES (:u, :m, :e)";
        $q = $b->pQuery($q, [":u"=>$path, ":m"=>$mime, ":e"=>$ext]);
        if(!$q){
            return 0;
        }
        return $b->lastInsertId();
    }


    static function ONE(\Main $b, string $name, ?callable $verify, ?string &$err):int {
        if(!isset($_FILES[$name])){
            $err = lnTranslate("No file is posted");
            return 0;
        }
        $file = $_FILES[$name];
        if($file["error"]){
            $err = lnTranslate("File upload failed with error code: ").$file["error"];
            return 0;
        }
        $file["ext"] = pathinfo($file["name"], PATHINFO_EXTENSION);
        //$file["mime"] = mime_content_type($file["tmp_name"]);
        if($verify && !$verify($file, $err)) return false;
        $dir  = "user_media/". date("Y/m/d/H")."/";
        if(!file_exists(ROOT."/".$dir) && !mkdir(ROOT."/".$dir, 0777, true)){
            $err = lnTranslate("Directory initialization failed!");
            return 0;
        }
        $name = $dir . time().".".$file["ext"];
        if(!move_uploaded_file($file["tmp_name"], ROOT."/".$name)){
            $err = lnTranslate("Failed while moving..");
            return 0;
        }
        
        return self::add($b, $name, $file["ext"], $file["type"], $err);
    }
    
    static function MULTI(\Main $b, ?callable $verify, ?string &$err):?array {
        if(!$_FILES) return [];
        $dir  = "user_media/". date("Y/m/d/H")."/";
        $name = $dir . time();
        if(!file_exists(ROOT."/".$dir) && !mkdir(ROOT."/".$dir, 0777, true)){
            $err = lnTranslate("Directory initialization failed!");
            return null;
        }
        $res = [];
        $i = -1;
        $err2 = null;
        foreach ($_FILES as $key => $file) {
            $i++;
            if($file["error"]){
                $res[$key] = lnTranslate("file_err").$file["error"];
                $res[$i] = $res[$key];
                continue;
            }
            $file["ext"] = pathinfo($file["name"], PATHINFO_EXTENSION);
            //$file["mime"] = mime_content_type($file["tmp_name"]);
            
            if($verify && !$verify($file, $err2)) {
                $res[$key] = $err2;
                $res[$i] = $err2;
                continue;
            }
            if(!move_uploaded_file($file["tmp_name"], ROOT.$name.$i.".".$file["ext"])){
                $res[$key] = lnTranslate("Failed while moving..");
                $res[$i] = $res[$key];
            }

            $res[$key] = self::add($b, $name, $file["ext"], $file["type"], $err2);
            if($res[$key]){
                $res[$i] = $res[$key];
            }else {
                $res[$key] = $err2;
                $res[$i] = $err2;
            }
        }
        return $res;
    }
}
