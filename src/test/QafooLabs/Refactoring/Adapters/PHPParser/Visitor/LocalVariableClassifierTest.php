<?php

namespace QafooLabs\Refactoring\Adapters\PHPParser\Visitor;

class LocalVariableClassifierTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function givenVariable_WhenClassification_ThenLocalVariableFound()
    {
        $classifier = new LocalVariableClassifier();
        $variable = new \PHPParser_Node_Expr_Variable("foo");

        $classifier->enterNode($variable);

        $this->assertEquals(array('foo'), $classifier->getLocalVariables());
    }

    /**
     * @test
     */
    public function givenAssignment_WhenClassification_ThenAssignmentFound()
    {
        $classifier = new LocalVariableClassifier();
        $assign = new \PHPParser_Node_Expr_Assign(
            new \PHPParser_Node_Expr_Variable("foo"),
            new \PHPParser_Node_Expr_Variable("bar")
        );

        $classifier->enterNode($assign);

        $this->assertEquals(array('foo'), $classifier->getAssignments());
    }

    /**
     * @test
     */
    public function givenThisVariable_WhenClassification_ThenNoLocalVariables()
    {
        $classifier = new LocalVariableClassifier();
        $variable = new \PHPParser_Node_Expr_Variable("this");

        $classifier->enterNode($variable);

        $this->assertEquals(array(), $classifier->getLocalVariables());
    }
}