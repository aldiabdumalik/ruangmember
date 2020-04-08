<?php
class Tools {
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    public function ubah_nohp($nohp)
    {
        $nohp = str_replace(" ","",$nohp);
        $nohp = str_replace("(","",$nohp);
        $nohp = str_replace(")","",$nohp);
        $nohp = str_replace(".","",$nohp);
        if(!preg_match('/[^+0-9]/',trim($nohp))){
            if(substr(trim($nohp), 0, 2)=='62'){
                $hp = trim($nohp);
            }elseif(substr(trim($nohp), 0, 3)=='+62'){
                $hp = str_replace("+","",$nohp);
            }elseif(substr(trim($nohp), 0, 1)=='0'){
                $hp = '62'.substr(trim($nohp), 1);
            }else{
                $hp = "Nomor Tidak Valid";
            }
        }else{
            $hp = "Nomor Tidak Valid";
        }
        return $hp;
    }

    public function str_random($length) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function str_random_abj($length) {
        $characters = 'ABCD0123EFGHI456JKLMNO789PQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function buildTree(array $elements, $parentId = 0) {
        $branch = array();

        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->buildTree($elements, $element['id_marketing']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }
}