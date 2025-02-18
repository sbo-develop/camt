<?php

declare(strict_types=1);

namespace Genkgo\Camt\Decoder;

use DateTimeImmutable;
use InvalidArgumentException;

class Date implements DateDecoderInterface
{
    /**
     * @var null|string
     */
    private $format;

    public function decode(string $date): DateTimeImmutable
    {
        if ($this->format === null) {
            $result = new DateTimeImmutable(substr($date,0,19));
        } else {
            $result = DateTimeImmutable::createFromFormat($this->format, $date);
        }

        if ($result === false) {
            throw new InvalidArgumentException("Cannot decode date {$date}");
        }

        return $result;
    }

    public static function fromFormat(string $format): self
    {
        $decoder = new self();
        $decoder->format = $format;

        return $decoder;
    }
}
