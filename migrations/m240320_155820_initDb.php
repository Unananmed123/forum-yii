<?php

use yii\db\Migration;

/**
 * Class m240320_155820_initDb
 */
class m240320_155820_initDb extends Migration
{

    public function safeUp()
    {
        $this->createTable(
            'users',
            [
                'id' => $this->primaryKey(),
                'login' => $this->string(50)->notNull(),
                'password' => $this->string()->notNull(),
                'photo' => $this->string(),
            ]);

        $this->createTable(
            'sections',
            [
                'id' => $this->primaryKey(),
                'title' => $this->string()->notNull(),
                'description' => $this->text()->notNull(),
            ]

        );

        $this->createTable(
            'subsections',
            [
                'id' => $this->primaryKey(),
                'title' => $this->string()->notNull(),
                'description' => $this->text()->notNull(),
                'section_id' => $this->integer()->notNull()
            ]

            );
        $this->createTable(
            'topics',
            [
                'id' => $this->primaryKey(),
                'title' => $this->string()->notNull(),
                'description' => $this->text()->notNull(),
                'subsection_id' => $this->integer()->notNull(),
                'user_id' => $this->integer()->notNull(),
            ]

        );

        $this->createTable(
            'messages',
            [
                'id' => $this->primaryKey(),
                'text' => $this->text()->notNull(),
                'topic_id' => $this->integer()->notNull(),
                'user_id' => $this->integer()->notNull(),
                'date' => $this->timestamp()->defaultExpression('NOW()'),
            ]

        );

        $this->insert('users', [
           'login' => 'admin',
           'password' => password_hash('password', PASSWORD_DEFAULT),
        ]);


        $this->addForeignKey(
          'message_to_topic_fk', //messages to topic
          'messages', //какую таблицу привязываем
          'topic_id',  // какую ячейку берем из таблицы
          'topics',  // из какой таблицы берем ячейку
          'id',  //к чему привязываемся
            "CASCADE",
            "CASCADE",
        );

        $this->addForeignKey(
            'message_to_user_fk', //messages to user
            'messages', //какую таблицу привязываем
            'user_id',  // какую ячейку берем из таблицы
            'users',  // из какой таблицы берем ячейку
            'id',  //к чему привязываемся
            "CASCADE",
            "CASCADE",
        );


        $this->addForeignKey(
            'topic_to_subsections_fk', //topics to subsections
            'topics', //какую таблицу привязываем
            'subsection_id',  // какую ячейку берем из таблицы
            'subsections',  // из какой таблицы берем ячейку
            'id',  //к чему привязываемся
            "CASCADE",
            "CASCADE",
        );

        $this->addForeignKey(
            'topic_to_users_fk', //topics to users
            'topics', //какую таблицу привязываем
            'user_id',  // какую ячейку берем из таблицы
            'users',  // из какой таблицы берем ячейку
            'id',  //к чему привязываемся
            "CASCADE",
            "CASCADE",
        );

        $this->addForeignKey(
            'subsections_to_sections_fk', //subsections to sections
            'subsections', //какую таблицу привязываем
            'section_id',  // какую ячейку берем из таблицы
            'sections',  // из какой таблицы берем ячейку
            'id',  //к чему привязываемся
            "CASCADE",
            "CASCADE",
        );
    }


    public function safeDown()
    {
       $this->dropTable("messages");
       $this->dropTable("topics");
       $this->dropTable("subsections");
       $this->dropTable("sections");
       $this->dropTable("users");
    }


}
