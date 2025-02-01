<?php
namespace App\Helpers;

class messageHelper
{

    public static function showErrorMessageWithTimeout(string $message, int $timeout = 5000, ?string $redirectUrl = null): void
    {
        echo "<style>

            #toastMessage {
                position: fixed;
                left: 50%;
                top: 20px;
                transform: translateX(-50%) translateY(-100%);
                background: #ffdddd;
                border: 1px solid #ff5f5f;
                padding: 15px 30px;
                color: #a70000;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
                font-family: 'Arial', sans-serif;
                z-index: 9999;
                opacity: 0;
                transition: opacity 0.5s ease, transform 0.5s ease;
            }

            #toastMessage.show {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            } 

            #toastMessage.hide {
                opacity: 0;
                transform: translateX(-50%) translateY(-20px);
            }
        </style>";


        echo "<div id='toastMessage'>{$message}</div>";


        echo "<script>
            (function(){
                var toast = document.getElementById('toastMessage');

                setTimeout(function(){
                    toast.classList.add('show');
                }, 100);

                setTimeout(function(){
                    toast.classList.remove('show');
                    toast.classList.add('hide');

                    setTimeout(function(){
                        if ('{$redirectUrl}' !== '') {
                            window.location.href = '{$redirectUrl}';
                        }
                    }, 500); 
                }, {$timeout});
            })();
        </script>";
    }

    public static function showSuccessMessageWithTimeout(string $message, int $timeout = 5000, ?string $redirectUrl = null): void
    {
        echo "<style>
            #toastSuccess {
                position: fixed;
                left: 50%;
                top: 20px;
                transform: translateX(-50%) translateY(-100%);
                background: #ddffdd;
                border: 1px solid #5fff5f;
                padding: 15px 30px;
                color: #007a00;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
                font-family: 'Arial', sans-serif;
                z-index: 9999;
                opacity: 0;
                transition: opacity 0.5s ease, transform 0.5s ease;
            }
            #toastSuccess.show {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }
            #toastSuccess.hide {
                opacity: 0;
                transform: translateX(-50%) translateY(-20px);
            }
        </style>";
    
        echo "<div id='toastSuccess'>{$message}</div>";
    
        echo "<script>
            (function(){
                var toast = document.getElementById('toastSuccess');
                setTimeout(function(){
                    toast.classList.add('show');
                }, 100);
                setTimeout(function(){
                    toast.classList.remove('show');
                    toast.classList.add('hide');
                    setTimeout(function(){
                        if ('{$redirectUrl}' !== '') {
                            window.location.href = '{$redirectUrl}';
                        }
                    }, 500);
                }, {$timeout});
            })();
        </script>";
    }
}
