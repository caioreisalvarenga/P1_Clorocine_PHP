<?php

class Mensagem
{
    //Método para mostrar a mensagem de filme cadastrado com sucesso
    public static function mostrar()
    {

        if (isset($_SESSION["msg"])) {
            $msg = $_SESSION["msg"];
            unset($_SESSION["msg"]);

            return "
                <script>
                    M.toast({
                        html: '$msg'
                    })
                </script>
            ";
        }
    }
}
