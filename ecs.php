<?php

declare(strict_types=1);

use PedroTroller\CS\Fixer\Comment\CommentLineToPhpdocBlockFixer;
use PedroTroller\CS\Fixer\DeadCode\UselessCodeAfterReturnFixer;
use PedroTroller\CS\Fixer\DoctrineMigrationsFixer;
use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\EmptyPHPStatementSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\ForbiddenFunctionsSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\LowerCaseTypeSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\RequireStrictTypesSniff;
use PHP_CodeSniffer\Standards\MySource\Sniffs\Debug\DebugCodeSniff;
use PHP_CodeSniffer\Standards\PSR1\Sniffs\Classes\ClassDeclarationSniff;
use PHP_CodeSniffer\Standards\PSR1\Sniffs\Files\SideEffectsSniff;
use PHP_CodeSniffer\Standards\PSR1\Sniffs\Methods\CamelCapsMethodNameSniff;
use PhpCsFixer\Fixer\Alias\MbStrFunctionsFixer;
use PhpCsFixer\Fixer\Basic\BracesFixer;
use PhpCsFixer\Fixer\Basic\NonPrintableCharacterFixer;
use PhpCsFixer\Fixer\Basic\NoTrailingCommaInSinglelineFixer;
use PhpCsFixer\Fixer\CastNotation\CastSpacesFixer;
use PhpCsFixer\Fixer\ClassNotation\ClassAttributesSeparationFixer;
use PhpCsFixer\Fixer\ClassNotation\FinalInternalClassFixer;
use PhpCsFixer\Fixer\ClassNotation\NoBlankLinesAfterClassOpeningFixer;
use PhpCsFixer\Fixer\ClassNotation\NoNullPropertyInitializationFixer;
use PhpCsFixer\Fixer\ClassNotation\OrderedClassElementsFixer;
use PhpCsFixer\Fixer\ConstantNotation\NativeConstantInvocationFixer;
use PhpCsFixer\Fixer\ControlStructure\ElseifFixer;
use PhpCsFixer\Fixer\ControlStructure\NoSuperfluousElseifFixer;
use PhpCsFixer\Fixer\ControlStructure\TrailingCommaInMultilineFixer;
use PhpCsFixer\Fixer\ControlStructure\YodaStyleFixer;
use PhpCsFixer\Fixer\FunctionNotation\FunctionDeclarationFixer;
use PhpCsFixer\Fixer\FunctionNotation\NativeFunctionInvocationFixer;
use PhpCsFixer\Fixer\FunctionNotation\NoSpacesAfterFunctionNameFixer;
use PhpCsFixer\Fixer\FunctionNotation\PhpdocToPropertyTypeFixer;
use PhpCsFixer\Fixer\FunctionNotation\PhpdocToReturnTypeFixer;
use PhpCsFixer\Fixer\FunctionNotation\SingleLineThrowFixer;
use PhpCsFixer\Fixer\FunctionNotation\StaticLambdaFixer;
use PhpCsFixer\Fixer\FunctionNotation\VoidReturnFixer;
use PhpCsFixer\Fixer\Import\FullyQualifiedStrictTypesFixer;
use PhpCsFixer\Fixer\Import\GlobalNamespaceImportFixer;
use PhpCsFixer\Fixer\LanguageConstruct\CombineConsecutiveIssetsFixer;
use PhpCsFixer\Fixer\LanguageConstruct\CombineConsecutiveUnsetsFixer;
use PhpCsFixer\Fixer\LanguageConstruct\DeclareEqualNormalizeFixer;
use PhpCsFixer\Fixer\LanguageConstruct\NoUnsetOnPropertyFixer;
use PhpCsFixer\Fixer\Operator\ConcatSpaceFixer;
use PhpCsFixer\Fixer\Operator\IncrementStyleFixer;
use PhpCsFixer\Fixer\Operator\NotOperatorWithSuccessorSpaceFixer;
use PhpCsFixer\Fixer\Operator\UnaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Phpdoc\NoSuperfluousPhpdocTagsFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocAnnotationWithoutDotFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocSummaryFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitMethodCasingFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitStrictFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitTestAnnotationFixer;
use PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer;
use PhpCsFixer\Fixer\Strict\StrictComparisonFixer;
use PhpCsFixer\Fixer\Whitespace\BlankLineBeforeStatementFixer;
use Symplify\CodingStandard\Fixer\ArrayNotation\StandaloneLineInMultilineArrayFixer;
use Symplify\CodingStandard\Fixer\LineLength\LineLengthFixer;
use Symplify\CodingStandard\Fixer\Strict\BlankLineAfterStrictTypesFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ECSConfig $ecsConfig): void {
    // import SetList here on purpose to avoid overridden by existing Skip Option in current config
    $ecsConfig->sets([SetList::CLEAN_CODE, SetList::COMMON, SetList::PSR_12, SetList::STRICT, ]);

    // Strict Types
    $ecsConfig->rule(BlankLineAfterStrictTypesFixer::class);
    $ecsConfig->rule(DeclareStrictTypesFixer::class);
    $ecsConfig->rule(StrictComparisonFixer::class);
    $ecsConfig->rule(RequireStrictTypesSniff::class);

    $ecsConfig->rule(FinalInternalClassFixer::class);
    $ecsConfig->rule(NoBlankLinesAfterClassOpeningFixer::class);
    $ecsConfig->rule(NoNullPropertyInitializationFixer::class);
    $ecsConfig->rule(NoUnsetOnPropertyFixer::class);

    // Function Notation
    $ecsConfig->rule(NoSpacesAfterFunctionNameFixer::class);
    $ecsConfig->rule(StaticLambdaFixer::class);
    $ecsConfig->rule(VoidReturnFixer::class);

    // Control Structures
    $ecsConfig->rule(StandaloneLineInMultilineArrayFixer::class);
    $ecsConfig->rule(EmptyPHPStatementSniff::class);
    $ecsConfig->rule(ElseifFixer::class);
    $ecsConfig->rule(NoSuperfluousElseifFixer::class);

    // Line length
    $ecsConfig->rule(LineLengthFixer::class);

    // Code style & legacy PHP fix
    $ecsConfig->rule(PhpdocToPropertyTypeFixer::class);

    $ecsConfig->ruleWithConfiguration(
        TrailingCommaInMultilineFixer::class,
        [
            'elements' => ['arrays', 'arguments'],
        ],
    )
    ;
    $ecsConfig->ruleWithConfiguration(YodaStyleFixer::class, [
        'equal' => true,
        'identical' => true,
        'less_and_greater' => true,
    ]);

    // PHPUnit
    $ecsConfig->ruleWithConfiguration(PhpUnitMethodCasingFixer::class, [
        'case' => 'snake_case',
    ],)
    ;

    // Naming
    $ecsConfig->ruleWithConfiguration(NativeFunctionInvocationFixer::class, [
        'include' => ['@internal'],
    ],)
    ;

    $ecsConfig->ruleWithConfiguration(NativeConstantInvocationFixer::class, [
        'include' => ['@internal'],
    ],)
    ;

    // Debug
    $ecsConfig->rule(DebugCodeSniff::class);
    $ecsConfig->ruleWithConfiguration(ForbiddenFunctionsSniff::class, [
        'forbiddenFunctions' => [
            'dump' => null,
            'var_dump' => null,
        ],
    ]);

    // multibyte
    $ecsConfig->rule(MbStrFunctionsFixer::class);

    // psr-1
    $ecsConfig->rule(ClassDeclarationSniff::class);
    $ecsConfig->rule(SideEffectsSniff::class);
    $ecsConfig->rule(CamelCapsMethodNameSniff::class);
    $ecsConfig->ruleWithConfiguration(FunctionDeclarationFixer::class, [
        'trailing_comma_single_line' => true,
    ]);

    $ecsConfig->ruleWithConfiguration(DeclareEqualNormalizeFixer::class, [
        'space' => 'none',
    ],)
    ;

    $ecsConfig->ruleWithConfiguration(
        BracesFixer::class,
        [
            'allow_single_line_closure' => false,
            'position_after_functions_and_oop_constructs' => 'next',
            'position_after_control_structures' => 'same',
            'position_after_anonymous_constructs' => 'same',
        ],
    )
    ;

    // merge issets
    $ecsConfig->rule(CombineConsecutiveIssetsFixer::class);
    $ecsConfig->rule(CombineConsecutiveUnsetsFixer::class);

    // remove useless phpdoc
    $ecsConfig->rule(PhpdocToReturnTypeFixer::class);
    $ecsConfig->rule(FullyQualifiedStrictTypesFixer::class);
    $ecsConfig->ruleWithConfiguration(NoSuperfluousPhpdocTagsFixer::class, [
        'allow_mixed' => true,
    ],)
    ;

    // arguable checkers, feel free to remove them
    $ecsConfig->ruleWithConfiguration(OrderedClassElementsFixer::class, [
        'order' => ['use_trait'],
    ],)
    ;

    // Whitespace
    $ecsConfig->ruleWithConfiguration(
        BlankLineBeforeStatementFixer::class,
        [
            'statements' => ['return', 'try', 'case', 'for', 'foreach', 'yield', 'while', 'switch', 'do'],
        ],
    )
    ;

    // this one is RISKY, but if you are sure your phpdoc is right then go on
    $ecsConfig->rule(LowerCaseTypeSniff::class);

    // Namespaces
    $ecsConfig->ruleWithConfiguration(
        GlobalNamespaceImportFixer::class,
        [
            'import_classes' => false,
            'import_constants' => false,
            'import_functions' => false,
        ],
    )
    ;

    // PedroTroller rules
    $ecsConfig->rule(CommentLineToPhpdocBlockFixer::class);
    $ecsConfig->rule(UselessCodeAfterReturnFixer::class);
    $ecsConfig->rule(DoctrineMigrationsFixer::class);

    $ecsConfig->paths([__DIR__.'/src', __DIR__.'/tests', __DIR__.'/ecs.php', __DIR__.'/docs/examples']);
    $ecsConfig->skip(
        [
            ClassAttributesSeparationFixer::class => null,
            OrderedClassElementsFixer::class => null,
            IncrementStyleFixer::class => null,
            UnaryOperatorSpacesFixer::class => null,
            PhpdocAnnotationWithoutDotFixer::class => null,
            PhpdocSummaryFixer::class => null,
            CastSpacesFixer::class => null,
            NotOperatorWithSuccessorSpaceFixer::class => null,
            SingleLineThrowFixer::class => null,
            CamelCapsMethodNameSniff::class => [__DIR__.'/tests/*'],
            NonPrintableCharacterFixer::class => [__DIR__.'/tests/*'],
            StaticLambdaFixer::class => [__DIR__.'/tests/*'],
            PhpUnitTestAnnotationFixer::class => null,
            PhpUnitStrictFixer::class => null,
            NativeConstantInvocationFixer::class => null,
            ConcatSpaceFixer::class => null,
            NoTrailingCommaInSinglelineFixer::class,
        ],
    );

    $ecsConfig->cacheDirectory('.cache/ecs');
    $ecsConfig->lineEnding("\n");
};
