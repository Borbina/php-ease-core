<?php

declare(strict_types=1);

/**
 * Ease Exception
 *
 * @author    Vitex <vitex@hippy.cz>
 * @copyright 2009-2018 Vitex@hippy.cz (G)
 * 
 * PHP 7
 */

namespace Ease;

/**
 * Exceptional use of EaseLogger to keep the message
 *
 * @author vitex
 */
class Exception extends \Exception
{

    /**
     * Ease Framework Exception
     * 
     * @param string          $message  of exception
     * @param int             $code     error code
     * @param \Ease\Exception $previous
     */
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        $trace = $this->getTrace();
        $caller = new Molecule();
        $where = $trace[0]['class'] . '::' . $trace[0]['function'];
        if (isset($trace[0]['line'])) {
            $caller->setObjectName($where . ':' . $trace[0]['line']);
        } else {
            $caller->setObjectName($where);
        }
        \Ease\Shared::logger()->addStatusObject(new Logger\Message($message, 'error', $caller));
        parent::__construct($message, $code, $previous);
    }

}
