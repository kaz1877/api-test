# コンテナ名
PHP := laravel-app
MYSQL := laravel-mysql

# DB 情報
MYSQL_USER := laravel
MYSQL_PW := laravel
DB := sanctum

ENV_PATH := src/.env
SHCMD := bash
TARGET := /srv/httpd


# docker コンテナ起動
.PHONY: up
up:
	docker-compose up -d
	docker-compose ps

# docker コンテナの起動状態確認
.PHONY: ps
ps:
	docker-compose ps

# docker コンテナと、イメージの削除
.PHONY: destroy
destroy:
	docker-compose down --rmi local

# docker コンテナと、イメージ・ボリュームの削除
.PHONY: destroy_force
destroy_force:
	docker-compose down --rmi local -v

# docker コンテナの停止
.PHONY: stop
stop:
	docker-compose stop

# docker コンテナの停止・起動
.PHONY: restart
restart:
	@make stop
	@make up

# キャッシュ削除
.PHONY: cache_clear
cache_clear:
	docker exec -it ${PHP} ${SHCMD} -c "export APP_ENV=local; php ${TARGET}/artisan cache:clear"

# キャッシュ作成
.PHONY: config_cache
config_cache:
	docker exec -it ${PHP} ${SHCMD} -c "export APP_ENV=local; php ${TARGET}/artisan config:cache"

# docker コンテナにログイン ( php コンテナ )
.PHONY: ssh
ssh:
	docker exec -it ${PHP} ${SHCMD}

# mysql にアクセス
.PHONY: mysql
mysql:
	docker exec -it ${MYSQL} ${SHCMD} -c "mysql -u ${MYSQL_USER} --password=${MYSQL_PW} ${DB}"

# docker ログ確認
.PHONY: logs
logs:
	docker-compose logs -f ${container}
