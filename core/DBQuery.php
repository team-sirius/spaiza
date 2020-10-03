<?php

/*
 *       ------------------
 *       *  Developed By: *
 *       ------------------
 *                                                                                dddddddd
 *                SSSSSSSSSSSSSSS                                                 d::::::d
 *              SS:::::::::::::::S                                                d::::::d
 *             S:::::SSSSSS::::::S                                                d::::::d
 *             S:::::S     SSSSSSS                                                d:::::d 
 *             S:::::S              aaaaaaaaaaaaa     aaaaaaaaaaaaa       ddddddddd:::::d 
 *             S:::::S              a::::::::::::a    a::::::::::::a    dd::::::::::::::d 
 *              S::::SSSS           aaaaaaaaa:::::a   aaaaaaaaa:::::a  d::::::::::::::::d 
 *               SS::::::SSSSS               a::::a            a::::a d:::::::ddddd:::::d 
 *                 SSS::::::::SS      aaaaaaa:::::a     aaaaaaa:::::a d::::::d    d:::::d 
 *                    SSSSSS::::S   aa::::::::::::a   aa::::::::::::a d:::::d     d:::::d 
 *                         S:::::S a::::aaaa::::::a  a::::aaaa::::::a d:::::d     d:::::d 
 *                         S:::::Sa::::a    a:::::a a::::a    a:::::a d:::::d     d:::::d 
 *             SSSSSSS     S:::::Sa::::a    a:::::a a::::a    a:::::a d::::::ddddd::::::dd
 *             S::::::SSSSSS:::::Sa:::::aaaa::::::a a:::::aaaa::::::a  d:::::::::::::::::d
 *             S:::::::::::::::SS  a::::::::::aa:::a a::::::::::aa:::a  d:::::::::ddd::::d
 *              SSSSSSSSSSSSSSS     aaaaaaaaaa  aaaa  aaaaaaaaaa  aaaa   ddddddddd   ddddd
 *
 *            ______________________________________________________________________________
 *                
 *                            Email: sakib.saad.khan@gmail.com
 *                            ++++++++++++++++++++++++++++++++
 *

 */

/**
 * Description of DBQuery
 *
 * @author Saad
 */
class DBQuery {
    protected PDO $pdo;
    protected ?string $error = null;
    public function __construct(string $dsn, ?string $user, ?string $pass) {
        try {
            $this->pdo=new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION
            ]);
        } catch (PDOException $exc) {
            die($exc->getMessage());
        }
    }
    
    public function query(string $sql): ?PDOStatement {
        try{
            return $this->pdo->query($sql);
        } catch (PDOException $ex) {
            $this->error=$ex->getMessage();
            return null;
        }
    }
    
    public function pQuery(string $sql, array $binds=[]):?PDOStatement {
        try{
            $prep= $this->pdo->prepare($sql);
            $prep->execute($binds);
            return $prep;
        } catch (PDOException $ex) {
            $this->error=$ex->getMessage();
            return null;
        }
    }
    
    public function delete(string $tbl, string $cond="", array $binds=[]):?int {
        try{
            $prep= $this->pdo->prepare("DELETE FROM $tbl".$cond?" WHERE $cond":"");
            $prep->execute($binds);
            return $prep->rowCount();
        } catch (PDOException $ex) {
            $this->error=$ex->getMessage();
            return null;
        }
    }
    
    public function lastInsertId(): int {
        return $this->pdo->lastInsertId();
    }
}
