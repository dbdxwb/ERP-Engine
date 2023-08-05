# shellcheck disable=SC2164
#执行应用引擎后台服务器
./code/backup/app-engine/vendor/bin/sail up -d
#执行py脚本服务器
cd code/script/tiktok-download
docker-compose up -d


