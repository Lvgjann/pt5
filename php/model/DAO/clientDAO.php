<?php
// require "model\DAO\param.php";
// require "model\DTO\clientDTO.php";
class clientDAO {    
    public static function selectSpeCli($parkod){
        $sql =  "select cartefid " .
        "from client c " .
        "inner join vente v " .
        "on c.cartefid = v.cartefidelite " .
        "where v.parkod10 = '" . $parkod . "'";
        $result = [];
         $listStrCarte = '';
        $request = DBConnex::getInstance()->prepare($sql);    
        $request->execute();
        $reqResult= $request->fetchAll(PDO::FETCH_ASSOC);
        var_dump($reqResult);
		if(!empty($reqResult)){
			foreach($reqResult as $client){
				$cli = new Client();
				$cli->hydrate($client);
                $result[]=$cli;
                $listStrCarte .= "'".$cli->getCarteFid()."',";
			}
        }
         $listStrCarte = substr($listStrCarte,0,strlen($listStrCarte)-1);
         var_dump($listStrCarte);
		return $listStrCarte;
    }
    public static function cleanClientNoel(){ // vide la table de travail 

        $sql = "Delete from clientNoel" ;    
        $request = DBConnex::getInstance()->prepare($sql);
        $request->execute();
    }

    public static function iniClientNoel(){ // remplit la table clientNoel avec les clients n'ayant acheté qu'à la periode de noel 
        ClientDAO::cleanClientNoel(); // On purge la table de ses données 


        $sql =
            "insert into clientnoel(idcli)
            SELECT distinct IDCLI
            FROM client as cli inner join vente as v on cli.cartefid = v.CARTEFIDELITE 
            where (substr(v.DATE,4,2) not in ('01','02','03','04','05','06','07','08','09','10')
                    or substr(v.DATE,1,5) not BETWEEN '01/11' and '25/11') 
            and v.DATE between '26/11/%' and '31/12/%'
            group by idcli
            having count(v.CARTEFIDELITE) > 0";

        $request = DBConnex::getInstance()->prepare($sql);
        var_dump($request);
        $request->execute();
    }

}