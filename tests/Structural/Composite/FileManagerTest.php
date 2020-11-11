<?php

namespace Opmvpc\Patrons\Tests\Structural\Composite;

use Exception;
use Opmvpc\Patrons\Structural\Composite\FileManager;
use PHPUnit\Framework\TestCase;

class FileManagerTest extends TestCase
{
    /** @test */
    public function create_current()
    {
        $fileManager = new FileManager();
        $this->assertInstanceOf(FileManager::class, $fileManager);
        $this->assertEquals('/', $fileManager->current()->name());
    }

    /** @test */
    public function test_create_folder()
    {
        $fileManager = new FileManager();
        $fileManager->createFolder('test');
        $this->assertEquals('test', $fileManager->current()->children()[0]->name());
    }

    /** @test */
    public function test_create_file()
    {
        $fileManager = new FileManager();
        $fileManager->createFile('test.jpg');
        $this->assertEquals('test.jpg', $fileManager->current()->children()[0]->name());
    }

    /** @test */
    public function test_create_file_children_always_empty()
    {
        $fileManager = new FileManager();
        $fileManager->createFile('test.jpg');
        $this->assertEmpty($fileManager->current()->children()[0]->children());
    }

    /** @test */
    public function test_create_file_already_exists_fail()
    {
        $fileManager = new FileManager();
        $fileManager->createFile('test.jpg');
        $this->expectException(Exception::class);
        $fileManager->createFile('test.jpg');
    }

    /** @test */
    public function test_root()
    {
        $fileManager = new FileManager();
        $this->assertEquals('/', $fileManager->root()->name());
    }

    /** @test */
    public function test_find_folder()
    {
        $fileManager = new FileManager();
        $fileManager->createFolder('parent');
        $fileManager->goTo('parent');
        $fileManager->createFolder('firstchild');
        $fileManager->createFolder('secondchild');
        $fileManager->goTo('secondchild');
        $fileManager->createFolder('thirdchild');
        $this->assertEquals('/', $fileManager->find('/')->name());
        $this->assertEquals('parent', $fileManager->find('parent')->name());
        $this->assertEquals('firstchild', $fileManager->find('firstchild')->name());
        $this->assertEquals('secondchild', $fileManager->find('secondchild')->name());
        $this->assertEquals('thirdchild', $fileManager->find('thirdchild')->name());
    }

    /** @test */
    public function test_find_file()
    {
        $fileManager = new FileManager();
        $fileManager->createFolder('parent');
        $fileManager->goTo('parent');
        $fileManager->createFile('test.jpg');
        $this->assertEquals('test.jpg', $fileManager->find('test.jpg')->name());
    }

    /** @test */
    public function test_find_fail()
    {
        $fileManager = new FileManager();
        $this->assertNull($fileManager->find('test'));
    }

    /** @test */
    public function test_go_to_folder_absolute()
    {
        $fileManager = new FileManager();
        $fileManager->createFolder('parent');
        $fileManager->goTo('parent');
        $fileManager->createFolder('firstchild');
        $fileManager->createFolder('secondchild');

        $fileManager->goTo('/');
        $this->assertEquals('/', $fileManager->current()->name());
        $fileManager->goTo('/parent');
        $this->assertEquals('parent', $fileManager->current()->name());
        $fileManager->goTo('/parent/firstchild');
        $this->assertEquals('firstchild', $fileManager->current()->name());
        $fileManager->goTo('/parent/secondchild');
        $this->assertEquals('secondchild', $fileManager->current()->name());
    }

    /** @test */
    public function test_go_to_folder_relative()
    {
        $fileManager = new FileManager();
        $fileManager->createFolder('parent');
        $fileManager->goTo('parent');
        $fileManager->createFolder('firstchild');
        $fileManager->createFolder('secondchild');

        $this->assertEquals('parent', $fileManager->current()->name());

        $fileManager->goTo('/');

        $fileManager->goTo('parent/firstchild');
        $this->assertEquals('firstchild', $fileManager->current()->name());

        $fileManager->goTo('/parent');

        $fileManager->goTo('./firstchild');
        $this->assertEquals('firstchild', $fileManager->current()->name());

        $fileManager->goTo('..');
        $this->assertEquals('parent', $fileManager->current()->name());

        $fileManager->goTo('..');
        $this->assertEquals('/', $fileManager->current()->name());

        $fileManager->goTo('parent/firstchild');
        $fileManager->goTo('../..');
        $this->assertEquals('/', $fileManager->current()->name());
    }

    /** @test */
    public function test_go_to_folder_fail()
    {
        $fileManager = new FileManager();
        $fileManager->createFolder('test');


        $this->expectException(Exception::class);
        $fileManager->goTo('coucou');
    }

    /** @test */
    public function test_go_to_file()
    {
        $fileManager = new FileManager();
        $fileManager->createFile('test.jpg');
        $fileManager->goTo('test.jpg');
        $this->assertEquals('/', $fileManager->current()->name());
    }

    /** @test */
    public function test_delete_folder()
    {
        $fileManager = new FileManager();
        $fileManager->createFolder('test');
        $fileManager->createFolder('coucou');
        $this->assertCount(2, $fileManager->current()->children());
        $fileManager->current()->delete('test');
        $this->assertCount(1, $fileManager->current()->children());
        $fileManager->current()->delete('coucou');
        $this->assertCount(0, $fileManager->current()->children());
    }

    /** @test */
    public function test_delete_file()
    {
        $fileManager = new FileManager();
        $fileManager->createFile('test.jpg');
        $fileManager->createFile('coucou.jpg');
        $this->assertCount(2, $fileManager->current()->children());
        $fileManager->current()->delete('test.jpg');
        $this->assertCount(1, $fileManager->current()->children());
        $fileManager->current()->delete('coucou.jpg');
        $this->assertCount(0, $fileManager->current()->children());
    }

    /** @test */
    public function test_delete_folder_fail()
    {
        $fileManager = new FileManager();
        $this->expectException(Exception::class);
        $fileManager->current()->delete('coucou.jpg');
    }

    /** @test */
    public function test_move_folder_relative()
    {
        $fileManager = new FileManager();
        $fileManager->createFolder('parent');
        $fileManager->goTo('parent');
        $fileManager->createFolder('firstchild');
        $fileManager->createFolder('secondchild');

        $fileManager->goTo('/');
        $fileManager->createFolder('new');

        $fileManager->move('parent', 'new');
        $this->assertEquals('firstchild', $fileManager->goTo('/new/parent/firstchild')->name());
    }

    /** @test */
    public function test_move_folder_absolute()
    {
        $fileManager = new FileManager();
        $fileManager->createFolder('parent');
        $fileManager->goTo('parent');
        $fileManager->createFolder('firstchild');
        $fileManager->createFolder('secondchild');

        $fileManager->goTo('/');
        $fileManager->createFolder('new');

        $fileManager->move('/parent', '/new');
        $this->assertEquals('firstchild', $fileManager->goTo('/new/parent/firstchild')->name());
    }

    /** @test */
    public function test_move_file()
    {
        $fileManager = new FileManager();
        $fileManager->createFolder('parent');
        $fileManager->goTo('parent');
        $fileManager->createFile('test.jpg');
        $this->assertCount(1, $fileManager->root()->children());
        $this->assertCount(1, $fileManager->current()->children());

        $fileManager->move('test.jpg', '/');
        $fileManager->goTo('/');
        $this->assertCount(2, $fileManager->root()->children());
        $this->assertEquals('parent', $fileManager->current()->children()[0]->name());
        $this->assertEquals('test.jpg', $fileManager->current()->children()[1]->name());
        $fileManager->goTo('parent');
        $this->assertCount(0, $fileManager->current()->children());
    }

    /** @test */
    public function test_move_fail()
    {
        $fileManager = new FileManager();
        $this->expectException(Exception::class);
        $fileManager->move('test.jpg', '/');

        $fileManager->createFolder('parent');

        $this->expectException(Exception::class);
        $fileManager->move('parent', '/new');
    }

    /** @test */
    public function test_move_root_fail()
    {
        $fileManager = new FileManager();
        $this->expectException(Exception::class);
        $fileManager->move('/', '/');
    }

    /** @test */
    public function test_copy_folder()
    {
        $fileManager = new FileManager();
        $fileManager->createFolder('parent');
        $fileManager->goTo('parent');
        $fileManager->createFolder('firstchild');
        $fileManager->createFolder('secondchild');

        $fileManager->goTo('/');
        $fileManager->createFolder('new');

        $fileManager->copy('parent', 'new');
        $this->assertEquals('firstchild', $fileManager->goTo('/parent/firstchild')->name());
        $this->assertEquals('firstchild', $fileManager->goTo('/new/parent/firstchild')->name());
    }

    /** @test */
    public function test_copy_file()
    {
        $fileManager = new FileManager();
        $fileManager->createFolder('parent');
        $fileManager->goTo('parent');
        $fileManager->createFile('test.jpg');
        $this->assertCount(1, $fileManager->root()->children());
        $this->assertCount(1, $fileManager->current()->children());

        $fileManager->copy('test.jpg', '/');
        $fileManager->goTo('/');
        $this->assertCount(2, $fileManager->root()->children());
        $this->assertEquals('parent', $fileManager->current()->children()[0]->name());
        $this->assertEquals('test.jpg', $fileManager->current()->children()[1]->name());
        $fileManager->goTo('parent');
        $this->assertEquals('test.jpg', $fileManager->current()->children()[0]->name());
        $this->assertCount(1, $fileManager->current()->children());
    }

    /** @test */
    public function test_find_child_id_fail()
    {
        $fileManager = new FileManager();
        $fileManager->createFolder('parent');
        $fileManager->goTo('parent');
        $fileManager->createFile('test.jpg');
        $fileManager->goTo('/');
        $this->assertNull($fileManager->current()->findChildId($fileManager->find('test.jpg')));
    }

    /** @test */
    public function test_same_as_file()
    {
        $fileManager = new FileManager();
        $fileManager->createFile('test.jpg');
        $fileManager->createFolder('parent');
        $fileManager->goTo('parent');
        $fileManager->createFile('test.jpg');
        $jpg1 = $fileManager->find('test.jpg');
        $jpg2 = $fileManager->find('test.jpg');
        $this->assertTrue($jpg1->isSameAs($jpg2));
    }

    /** @test */
    public function test_same_as_folder()
    {
        $fileManager = new FileManager();
        $fileManager->createFolder('first');
        $fileManager->goTo('first');
        $fileManager->createFile('test.jpg');
        $fileManager->createFolder('child');
        $fileManager->goTo('/');
        $fileManager->createFolder('second');
        $fileManager->goTo('second');
        $fileManager->createFile('test.jpg');
        $fileManager->createFolder('child');
        $this->assertTrue($fileManager->find('first')->isSameAs($fileManager->find('second')));
    }

    /** @test */
    public function test_same_as_file_fail()
    {
        $fileManager = new FileManager();
        $fileManager->createFile('test.jpg');
        $fileManager->createFolder('parent');
        $fileManager->goTo('parent');
        $fileManager->createFile('test2.jpg');
        $jpg1 = $fileManager->root()->children()[0];
        $jpg2 = $fileManager->current()->children()[0];
        $this->assertFalse($jpg1->isSameAs($jpg2));
    }

    /** @test */
    public function test_same_as_folder_fail()
    {
        $fileManager = new FileManager();
        $fileManager->createFolder('first');
        $fileManager->goTo('first');
        $fileManager->createFile('test.jpg');
        $fileManager->createFolder('child');
        $fileManager->goTo('/');
        $fileManager->createFolder('second');
        $fileManager->goTo('second');
        $fileManager->createFile('test.jpg');
        $fileManager->createFolder('coucou');
        $this->assertFalse($fileManager->find('first')->isSameAs($fileManager->find('second')));
    }

    /** @test */
    public function test_is_in_same_folder_as_file()
    {
        $fileManager = new FileManager();
        $fileManager->createFolder('parent');
        $fileManager->goTo('parent');
        $fileManager->createFile('test.jpg');
        $fileManager->createFile('test2.jpg');
        $jpg1 = $fileManager->current()->children()[0];
        $jpg2 = $fileManager->current()->children()[1];
        $this->assertTrue($jpg1->isInSameFolderAs($jpg2));
    }

    /** @test */
    public function test_is_in_same_folder_as_file_fail()
    {
        $fileManager = new FileManager();
        $fileManager->createFile('test.jpg');
        $fileManager->createFolder('parent');
        $fileManager->goTo('parent');
        $fileManager->createFile('test2.jpg');
        $jpg1 = $fileManager->root()->children()[0];
        $jpg2 = $fileManager->current()->children()[0];
        $this->assertFalse($jpg1->isInSameFolderAs($jpg2));
    }
}
