<?php

use yii\db\Migration;

/**
 * Handles the creation for table `faq_tables`.
 */
class m160506_062737_create_faq_tables extends Migration
{
    public $langTbl     = "{{%faq_languages}}";
    public $groupTbl    = "{{%faq_groups}}";
    public $qaTbl       = "{{%faq_qa}}";
    public $tblOptions 	= 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

    public function __construct(array $config)
    {
        parent::__construct($config);

        if ($this->db->driverName === 'pgsql') $this->tblOptions = '';
    }

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        // create table for languages
        $this->createTable($this->langTbl, [
            'id' 			=> $this->primaryKey(),
            'code'			=> $this->string(6)->notNull()->unique(),
            'name'			=> $this->string(30)->notNull(),
            'created_at' 	=> $this->integer(),
            'updated_at' 	=> $this->integer(),
        ], $this->tblOptions);

        // create indexes
        //$this->createIndex('faq_lang_unique_code', $this->langTbl, 'code', true);
        $this->createIndex('faq_lang_unique_code_name', $this->langTbl, ['code', 'name'], true);

        // add some languages
        $time = time();
        $this->insert($this->langTbl, ['code' => 'ru-RU', 'name' => 'Русский', 'created_at' => $time, 'updated_at' => $time]);
        $this->insert($this->langTbl, ['code' => 'en-US', 'name' => 'English', 'created_at' => $time, 'updated_at' => $time]);

        // create table for groups of QA
        $this->createTable($this->groupTbl, [
            'id' 			=> $this->primaryKey(),
            'name'			=> $this->string(255)->notNull(),
            'lang_id'       => $this->integer()->notNull(),
            'created_at' 	=> $this->integer(),
            'updated_at' 	=> $this->integer(),
        ], $this->tblOptions);

        // add constraints and indexes
        $this->addForeignKey('fk_groups_langs', $this->groupTbl, 'lang_id', $this->langTbl, 'id', 'CASCADE', 'RESTRICT');
        $this->createIndex('faq_groups_unique_name', $this->groupTbl, ['name', 'lang_id'], true);

        // create table for QA
        $this->createTable($this->qaTbl, [
            'id' 			=> $this->primaryKey(),
            'question'		=> $this->text()->notNull(),
            'answer'		=> $this->text()->notNull(),
            'group_id'      => $this->integer()->notNull(),
            'created_at' 	=> $this->integer(),
            'updated_at' 	=> $this->integer(),
        ], $this->tblOptions);

        // add constraints and indexes
        $this->addForeignKey('fk_qa_groups', $this->qaTbl, 'group_id', $this->groupTbl, 'id', 'CASCADE', 'RESTRICT');
        $this->createIndex('faq_qa_unique_questions_ingroup', $this->qaTbl, [$this->db->driverName === 'pgsql' ? 'question' : 'question(100)', 'group_id'], true);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable($this->qaTbl);
        $this->dropTable($this->groupTbl);
        $this->dropTable($this->langTbl);
    }
}
