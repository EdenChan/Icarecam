<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mailer {

    var $mail;

    public function __construct()
    {
        require_once('PHPMailer/class.phpmailer.php');

        // the true param means it will throw exceptions on errors, which we need to catch
        $this->mail = new PHPMailer(true);

        $this->mail->IsSMTP(); // 设置SMTP为邮箱发送协议

        $this->mail->CharSet = "utf-8";                  // 设置邮箱发送编码
        $this->mail->SMTPDebug  = 0;                     // 开启SMTP调试信息
        $this->mail->SMTPAuth   = true;                  // 开启SMTP认证
        $this->mail->Host       = "smtp.163.com";      // SMTP服务器
        $this->mail->Port       = 25;                   // SMTP端口
        $this->mail->Username   = "wlws2012@163.com";// 邮箱账户
        $this->mail->Password   = "sgyzzgq";       // 邮箱密码
        $this->mail->AddReplyTo('wlws2012@163.com', 'Icarecam官方网站');
        $this->mail->SetFrom('wlws2012@163.com', 'Icarecam官方网站');

    }

    public function sendmail($to, $to_name, $subject, $body){
        try{
            $this->mail->AddAddress($to, $to_name);

            $this->mail->Subject = $subject;
            $this->mail->Body    = $body;

            $this->mail->Send();

        } catch (phpmailerException $e) {
            echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
            echo $e->getMessage(); //Boring error messages from anything else!
        }
    }
}