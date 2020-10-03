<?php

/*

  ---------------------------------------------------=======================-------------------------------------------------------
 *                                                                                                                               *
 *            PPPPPPPPPPPPPPPPP                                                                                                  *
 *            P::::::::::::::::P                                                                                                 *
 *            P::::::PPPPPP:::::P                                                                                                *
 *            PP:::::P     P:::::P                                                                                               *
 *              P::::P     P:::::P  aaaaaaaaaaaaa   yyyyyyy           yyyyyyyrrrrr   rrrrrrrrr     aaaaaaaaaaaaa                 *
 *              P::::P     P:::::P  a::::::::::::a   y:::::y         y:::::y r::::rrr:::::::::r    a::::::::::::a                *
 *              P::::PPPPPP:::::P   aaaaaaaaa:::::a   y:::::y       y:::::y  r:::::::::::::::::r   aaaaaaaaa:::::a               *
 *              P:::::::::::::PP             a::::a    y:::::y     y:::::y   rr::::::rrrrr::::::r           a::::a               *
 *              P::::PPPPPPPPP        aaaaaaa:::::a     y:::::y   y:::::y     r:::::r     r:::::r    aaaaaaa:::::a               *
 *              P::::P              aa::::::::::::a      y:::::y y:::::y      r:::::r     rrrrrrr  aa::::::::::::a               *
 *              P::::P             a::::aaaa::::::a       y:::::y:::::y       r:::::r             a::::aaaa::::::a               *
 *              P::::P            a::::a    a:::::a        y:::::::::y        r:::::r            a::::a    a:::::a               *
 *            PP::::::PP          a::::a    a:::::a         y:::::::y         r:::::r            a::::a    a:::::a               *
 *            P::::::::P          a:::::aaaa::::::a          y:::::y          r:::::r            a:::::aaaa::::::a               *
 *            P::::::::P           a::::::::::aa:::a        y:::::y           r:::::r             a::::::::::aa:::a              *
 *            PPPPPPPPPP            aaaaaaaaaa  aaaa       y:::::y            rrrrrrr              aaaaaaaaaa  aaaa              *
 *                                                        y:::::y                                                                *
 *                                                       y:::::y                                                                 *
 *                                                      y:::::y                                                                  *
 *                                                     y:::::y                                                                   *
 *                                                   yyyyyyy                                                                     *
 *                                                                                                                               *
 * -------------------------------------------------+++++++++++++++++++++++++------------------------------------------------------


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

namespace In;
/**
 * Description of User
 *
 * @author Saad
 */
class User extends \Base\User{
    public function __construct() {
        parent::__construct();
    }
    
    
    private function set(string $col, string $val): bool {
        $q = "UPDATE `users` SET $col=:v WHERE id = $this->uid";
        $q = $this->pQuery($q, [":v"=>$val]);
        if(!$q) return false;
        return true;
    }
    
    public function setPhoto(int $photo): bool {
        return $this->set("photo", $photo);
    }
    
    
    
    
}
