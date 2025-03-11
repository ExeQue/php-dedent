<?php

declare(strict_types=1);

namespace ExeQue\Dedent;

class Dedent
{

    public function __construct(
        private string $input,
        private int    $tabWidth = 4,
    ) {
    }

    public static function dedent(
        string $input,
        int    $tabWidth = 4,
    ): string {
        return (new self($input, $tabWidth))->process();
    }

    private function spacing(): ?int
    {
        $spacing = null;

        $lines = explode("\n", $this->input);

        foreach ($lines as $line) {
            if (trim($line) === '') {
                continue;
            }

            $lineSpacing = strlen($line) - strlen(ltrim($line));

            if($lineSpacing === 0) {
                return 0;
            }

            if ($spacing === null || $lineSpacing < $spacing) {
                $spacing = $lineSpacing;
            }
        }

        return $spacing;
    }

    private function process(): string
    {
        $this->input = $this->fixTabs($this->input);

        $min = $this->spacing();

        if ($min === null || $min === 0) {
            return $this->input;
        }

        $lines = explode("\n", $this->input);

        foreach ($lines as $key => $line) {
            $lines[$key] = substr($line, $min);
        }

        return implode("\n", $lines);
    }

    private function fixTabs(string $line): string
    {
        return preg_replace('/\t/', str_repeat(' ', $this->tabWidth), $line);
    }
}