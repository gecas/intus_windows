<?php

use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use PhpCsFixer\Fixer\ArrayNotation\NoMultilineWhitespaceAroundDoubleArrowFixer;
use PhpCsFixer\Fixer\ArrayNotation\NormalizeIndexBraceFixer;
use PhpCsFixer\Fixer\ArrayNotation\NoTrailingCommaInSinglelineArrayFixer;
use PhpCsFixer\Fixer\ArrayNotation\TrimArraySpacesFixer;
use PhpCsFixer\Fixer\ArrayNotation\WhitespaceAfterCommaInArrayFixer;
use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use PhpCsFixer\Fixer\LanguageConstruct\SingleSpaceAfterConstructFixer;
use PhpCsFixer\Fixer\NamespaceNotation\SingleBlankLineBeforeNamespaceFixer;
use PhpCsFixer\Fixer\Whitespace\ArrayIndentationFixer;
use PhpCsFixer\Fixer\Whitespace\BlankLineBeforeStatementFixer;
use PhpCsFixer\Fixer\Whitespace\NoExtraBlankLinesFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ECSConfig $ecsConfig): void {
    $ecsConfig->sets([SetList::PSR_12, SetList::CLEAN_CODE]);
    $ecsConfig->rule(SingleBlankLineBeforeNamespaceFixer::class);
    $ecsConfig->rule(BlankLineBeforeStatementFixer::class);
    $ecsConfig->rule(NoExtraBlankLinesFixer::class);
    $ecsConfig->rule(SingleSpaceAfterConstructFixer::class);
    $ecsConfig->rule(ArrayIndentationFixer::class);
    $ecsConfig->rule(NormalizeIndexBraceFixer::class);
    $ecsConfig->rule(WhitespaceAfterCommaInArrayFixer::class);
    $ecsConfig->rule(NoMultilineWhitespaceAroundDoubleArrowFixer::class);
    $ecsConfig->rule(TrimArraySpacesFixer::class);
    $ecsConfig->rule(NoTrailingCommaInSinglelineArrayFixer::class);
    $ecsConfig->rule(NoUnusedImportsFixer::class);
    $ecsConfig->rule(ArraySyntaxFixer::class);
};
