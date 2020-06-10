<?php
// require "model\DAO\param.php";

class productDAO {
    public static function cleanTraProduit(){ // vide la table de travail 

        $sql = "Delete from tra_produit" ;    
        $request = DBConnex::getInstance()->prepare($sql);
        $request->execute();
    }


    public static function prepRqClassique($listCarteFid,$parkod10){
        return " and  v.cartefidelite in ($listCarteFid) and v.parkod10 !=  '$parkod10' ";
    }
    public static function prepRqGenre( $genre){
        return  " and c.sexe = $genre ";
    }
    public static function prepRqPeriode( $periode){
        if ($periode == 2 ){
            return  " and v.date not between '26/11/%%%%' and '31/12/%%%%'";
        }else if ($periode == 1){
            return  " and v.date  between '26/11/%%%%' and '31/12/%%%%'";
        }
       
    }
    public static function prepRqPlageAge($pAge){
        if ($pAge == 1){
            return " and c.age < 62 ";
        }
        else if($pAge == 2 ){
            return " and c.age >= 62";
        }
    }
    public static function prepRqLimClientNoel($val){
        if ($val == 1){
            return " and EXISTS (select 1 from clientnoel cn where cn.idcli = c.idcli)";
        }
    }
    
    public static function iniTraProduit($listCarteFid = null ,$parkod10 = null,$genre = null, $periode = null, $pAge = null, $limitCli = null){ // remplit la table de travail 
        productDAO::cleanTraProduit(); // On purge la table de ses données 

        $sql ="insert into tra_produit select parkod10 " .
            "from vente v  inner join client c on v.cartefidelite = c.cartefid " .
            " where 1 = 1 " ;
        if ($listCarteFid!= null || $parkod10!=null){ 
            $sql .= productDAO::prepRqClassique($listCarteFid,$parkod10);
        }
        if ($genre != null && ($genre == 1||$genre ==2)){ // genre 2 -> femme, genre 1 -> homme 
            $sql .= productDAO::prepRqGenre($genre);
        }
        if ($periode != null && ($periode == 1||$periode ==2)){ // periode = 2 = hors noel ; periode = 1 =  noel
            $sql .= productDAO::prepRqPeriode($periode);
        }
        if ($pAge != null && ($pAge == 1||$pAge ==2)){ // 1 = "jeune" (<62) ; 2 = "vieux" >= 62
            $sql .= productDAO::prepRqPlageAge($pAge);
        }       
        if ($limitCli != null && ($limitCli == 1)){ // 1 = limitation des clients à ceux ne consommant qu'à noel, et qui sont present dan clientnoel
            $sql .= productDAO::prepRqLimClientNoel($limitCli);
        }  
        $request = DBConnex::getInstance()->prepare($sql);
        var_dump($request);
        $request->execute();


    }

    public static function mostConsumeProduct(){
        $sql =  "select parkod10, count(parkod10) maxi from tra_produit group by parkod10 having count(parkod10) = ( select count(parkod10) from tra_produit group by parkod10 ORDER by COUNT(parkod10) DESC LIMIT 1 )";
        $result = [];
        $request = DBConnex::getInstance()->prepare($sql);    
        $request->execute();
        $reqResult= $request->fetchAll(PDO::FETCH_ASSOC);
        var_dump($reqResult);
		if(!empty($reqResult)){
			foreach($reqResult as $product){
				$prod = new Product();
				$prod->hydrate($product);
				$result[]=$prod;
			}
		}
		return $result;
    }
    
    
   
}
