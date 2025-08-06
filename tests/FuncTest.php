<?php
// File: tests/FuncTest.php
use PHPUnit\Framework\TestCase;

require_once 'func.php';

class FuncTest extends TestCase
{
    private $db;

    protected function setUp(): void
    {
        // Mock database connection
        $this->db = getDB();
    }

    public function testGetDB()
    {
        $this->assertTrue($this->db[0], 'Database connection should be successful');
        $this->assertInstanceOf(mysqli::class, $this->db[1], 'Database connection should return a mysqli instance');
    }

    public function testCreateUserSuccess()
    {
        $user = [
            'login' => 'testuser',
            'prenom' => 'John',
            'nom' => 'Doe',
            'password' => 'password123',
            'pwc' => 'password123'
        ];

        $this->assertTrue(createUser($this->db, $user), 'User creation should succeed');
    }

    public function testCreateUserValidationError()
    {
        $user = [
            'login' => '',
            'prenom' => 'John',
            'nom' => 'Doe',
            'password' => 'password123',
            'pwc' => 'password123'
        ];

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Identifiant vide');
        createUser($this->db, $user);
    }

    public function testErrorHandler()
    {
        $this->assertEquals('Mot de passe vide', errorHandler(1), 'Error message for code 01 should match');
        $this->assertEquals('Identifiant vide', errorHandler(10), 'Error message for code 10 should match');
    }
}