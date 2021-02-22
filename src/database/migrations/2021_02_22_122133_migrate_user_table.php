<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigrateUserTable extends Migration
{
    const TABLE = 'users';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable(self::TABLE)) {
            $this->createUserTable();
            return;
        }
        $this->quiet(function () {
            Schema::table(self::TABLE, function (Blueprint $table) {
                $table->timestamps();
            });
        });
        Schema::table(self::TABLE, function (Blueprint $table) {
            $this->hasColumn('remember_token')
            || $table->rememberToken()->index()->comment('记住我');

            $this->hasColumn('deleted_at')
            || $table->softDeletes();

            $this->hasColumn('name')
            || $table->string('name')->index()->comment('用户名');

            $this->hasColumn('email_verified_at')
            || $table->timestamp('email_verified_at')->nullable()->comment('邮箱验证时间');

            $this->hasColumn('password')
            || $table->string('password', 200)->comment('密码 Hash');

            $this->hasColumn('nickname')
            || $table->string('nickname', 30)->comment('昵称')->unique();

            $this->hasColumn('email')
            || $table->string('email', 100)->comment('邮箱（可用于登录）')->unique();

            $this->hasColumn('phone')
            || $table->char('phone', 11)->comment('手机号（可用于登录）')->unique()->default('');

            $this->hasColumn('level')
            || $table->unsignedTinyInteger('level')->default(0)->comment('用户等级，限定规则 0 表示允许评论，但是必须审核');
        });
    }

    private function createUserTable()
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->rememberToken();
            $table->string('name')->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 200)->comment('密码 Hash');
            $table->string('nickname', 30)->comment('昵称')->unique();
            $table->string('email', 100)->comment('邮箱（可用于登录）')->unique();
            $table->char('phone', 11)->comment('手机号（可用于登录）')->unique()->default('');
            $table->unsignedTinyInteger('level')->default(0)->comment('用户等级，限定规则 0 表示允许评论，但是必须审核');
        });
    }

    private function quiet(callable $callable)
    {
        try {
            $callable();
        } catch (Throwable $exception) {
            logger()?->error(sprintf('Migration Exception: %s', $exception->getMessage()), [$exception]);
        }
    }

    private function hasColumn($column)
    {
        return Schema::hasColumn(self::TABLE, $column);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $columns = [
            'nickname',
            'level',
        ];
        foreach ($columns as $column) {
            if (!Schema::hasColumn(self::TABLE, $column)) {
                continue;
            }
            $this->quiet(function () use ($column) {
                Schema::dropColumns(self::TABLE, [$column]);
            });
        }
    }
}
