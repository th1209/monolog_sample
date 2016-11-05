<?php

require '../vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\ChromePHPHandler;
use Monolog\Handler\NativeMailerHandler;


/**
 * Loggerの生成
 */
$log = new Logger("Name of this logger instance");
$log->setTimezone(new DateTimeZone("Asia/Tokyo"));//タイムゾーンのセットも可 (php.iniで設定するのが普通なので、滅多に使わないと思うが...)


/**
 * Handlerの追加
 */
$log->pushHandler(new StreamHandler('your file path', Logger::NOTICE));
$log->pushHandler(new NativeMailerHandler("to", "subject", "from", Logger::INFO));
$log->pushHandler(new ChromePHPHandler(Logger::DEBUG));


/**
 * ロギング実施。以下の点に注目。
 * ・メソッドの呼び出し毎に、リソースへのアクセスが行われる -> メール送信などに注意
 * ・pushした全Handlerに対し、通知が行われる
 * ・レベルに満たない緊急度のログは行われない。 ex)HandlerのレベルをNOTICEとした場合、DEBUGやINFOなどのログは無視される。
 * ・addInfo, addNoticeなどの'add'で始まるメソッドも残っている模様。後方互換性のためであり、PSR-3準拠でないので使わないこと。
 */
$log->info("sent info.");
$log->notice("sent notice.");
$log->debug("sent debug.");








