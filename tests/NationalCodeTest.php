<?php

declare(strict_types=1);

namespace IranianNationalCode\Test;

use IranianNationalCode\NationalCode;
use PHPUnit\Framework\TestCase;

ini_set('memory_limit', '1024M');

final class NationalCodeTest extends TestCase
{

    private NationalCode $nationalCode;

    private array $invalidCodes = [
        '1111111111',
        '2222222222',
        '3333333333',
        '4444444444',
        '5555555555',
        '6666666666',
        '7777777777',
        '8888888888',
        '9999999999',
        '0000000000'
    ];

    protected function setUp(): void
    {
        $this->nationalCode = new NationalCode();
    }

    public function testItCanInvalidateTheUnusualCodes(): void
    {
        $count = 0;
        foreach ($this->invalidCodes as $unusualCode) {
            $result = $this->nationalCode->checkNationalCodeValidation($unusualCode);
            if ($result === false) {
                $count++;
            }
        }

        self::assertEquals(10, $count);
    }

    public function testItCanValidateNationalCodes(): void
    {
        $result = $this->nationalCode->checkNationalCodeValidation('4561802479');
        self::assertTrue($result);
    }

    public function testItCanInvalidateNationalCodes(): void
    {
        $result = $this->nationalCode->checkNationalCodeValidation('4561802472');
        self::assertFalse($result);
    }

    public function testItCanCheckNationalCodesWithParityZero(): void
    {
        $result = $this->nationalCode->checkNationalCodeValidation('4448980510');
        self::assertTrue($result);
    }

    public function testItCanCheckNationalCodesWithParityOne(): void
    {
        $result = $this->nationalCode->checkNationalCodeValidation('0949416691');
        self::assertTrue($result);
    }

    public function testItCanGenerateNationalCodes(): void
    {
        do {
            $theActualCode = $this->nationalCode->generateNationalCode();
            $result = $this->nationalCode->checkNationalCodeValidation($theActualCode);
            $splited = str_split($theActualCode);
            $parity = $splited[9];
        } while($parity === '0' || $parity === '1');

        self::assertTrue($result);
    }

    public function testItCanGenerateNationalCodesWithParityZero(): void
    {
        do {
            $theActualCode = $this->nationalCode->generateNationalCode();
            $result = $this->nationalCode->checkNationalCodeValidation($theActualCode);
            $splited = str_split($theActualCode);
            $parity = $splited[9];
        } while($parity !== '0');

        self::assertTrue($result);
    }

    public function testItCanGenerateNationalCodesWithParityOne(): void
    {
        do {
            $theActualCode = $this->nationalCode->generateNationalCode();
            $result = $this->nationalCode->checkNationalCodeValidation($theActualCode);
            $splited = str_split($theActualCode);
            $parity = $splited[9];
        } while($parity !== '1');

        self::assertTrue($result);
    }

    public function testItCanInvalidateCharacters(): void
    {
        $result = $this->nationalCode->checkNationalCodeValidation('hello');
        self::assertFalse($result);
    }
}
