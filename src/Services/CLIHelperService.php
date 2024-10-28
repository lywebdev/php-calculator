<?php

declare(strict_types=1);

namespace App\Services;

final class CLIHelperService
{
    public function textInput(): string
    {
        $stdin = fgets(STDIN);
        if ($stdin === false) {
            $this->exit();
        }

        return trim($stdin);
    }

    public function exit(): void
    {
        exit("Bye!");
    }

    public function confirmation(string $message): void
    {
        echo $message . ' Please enter y or n: ';
        $confirmationSymbol = mb_strtolower($this->textInput());

        if ($confirmationSymbol !== 'y') {
            $this->exit();
        }
    }
}