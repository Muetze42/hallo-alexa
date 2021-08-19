<?php

namespace App\Http\Controllers;

use App\Notifications\Telegram\ErrorReport;
use App\Nova\Metrics\Referrer\ReferrerDomain;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;


class DevelopmentController extends Controller
{
    public function index()
    {
        $string = '[2021-07-30 14:02:02] production.ERROR: stream_socket_enable_crypto(): Peer certificate CN=`root1365.premium-rootserver.net\' did not match expected CN=`hallo.tools\' {"exception":"[object] (ErrorException(code: 0): stream_socket_enable_crypto(): Peer certificate CN=`root1365.premium-rootserver.net\' did not match expected CN=`hallo.tools\' at /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php:94)
[stacktrace]
#0 [internal function]: Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError()
#1 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/StreamBuffer.php(94): stream_socket_enable_crypto()
#2 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/EsmtpTransport.php(348): Swift_Transport_StreamBuffer->startTLS()
#3 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Transport/AbstractSmtpTransport.php(148): Swift_Transport_EsmtpTransport->doHeloCommand()
#4 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/swiftmailer/swiftmailer/lib/classes/Swift/Mailer.php(65): Swift_Transport_AbstractSmtpTransport->start()
#5 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(521): Swift_Mailer->send()
#6 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(288): Illuminate\\Mail\\Mailer->sendSwiftMessage()
#7 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(186): Illuminate\\Mail\\Mailer->send()
#8 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()
#9 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(187): Illuminate\\Mail\\Mailable->withLocale()
#10 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/laravel/framework/src/Illuminate/Mail/SendQueuedMailable.php(65): Illuminate\\Mail\\Mailable->send()
#11 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle()
#12 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/laravel/framework/src/Illuminate/Container/Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()
#13 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()
#14 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()
#15 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/laravel/framework/src/Illuminate/Container/Container.php(611): Illuminate\\Container\\BoundMethod::call()
#16 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()
#17 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()
#18 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()
#19 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()
#20 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(118): Illuminate\\Bus\\Dispatcher->dispatchNow()
#21 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()
#22 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()
#23 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(120): Illuminate\\Pipeline\\Pipeline->then()
#24 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()
#25 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()
#26 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(410): Illuminate\\Queue\\Jobs\\Job->fire()
#27 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(360): Illuminate\\Queue\\Worker->process()
#28 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(158): Illuminate\\Queue\\Worker->runJob()
#29 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(117): Illuminate\\Queue\\Worker->daemon()
#30 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(101): Illuminate\\Queue\\Console\\WorkCommand->runWorker()
#31 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()
#32 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/laravel/framework/src/Illuminate/Container/Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()
#33 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()
#34 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()
#35 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/laravel/framework/src/Illuminate/Container/Container.php(611): Illuminate\\Container\\BoundMethod::call()
#36 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/laravel/framework/src/Illuminate/Console/Command.php(136): Illuminate\\Container\\Container->call()
#37 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/symfony/console/Command/Command.php(256): Illuminate\\Console\\Command->execute()
#38 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run()
#39 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/symfony/console/Application.php(971): Illuminate\\Console\\Command->run()
#40 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/symfony/console/Application.php(290): Symfony\\Component\\Console\\Application->doRunCommand()
#41 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/symfony/console/Application.php(166): Symfony\\Component\\Console\\Application->doRun()
#42 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/laravel/framework/src/Illuminate/Console/Application.php(92): Symfony\\Component\\Console\\Application->run()
#43 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run()
#44 /var/www/vhosts/hallo.tools/httpdocs/hallo.tools-system/website/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()
#45 {main}
"}
d
';


    }
}
