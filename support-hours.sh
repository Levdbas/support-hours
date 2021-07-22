#! /bin/bash
dev="/mnt/d/laragon/www/testenvironment.local/web/app/plugins/support-hours"
trunk="/mnt/d/laragon/www/Anders/support-hours/trunk"
release="/mnt/d/laragon/www/Anders/support-hours"
read -p 'Release number:' releasenumber
echo 'Get fresh production files'
yarn run production
echo 'Empty trunk'
rm -r $trunk/*
echo 'Copy files from testenv to version dir'
cp -R $dev/admin/ $trunk/admin/
cp -R $dev/includes/ $trunk/includes/
cp -R $dev/languages/ $trunk/languages/
cp -R $dev/dist/ $trunk/dist/
cp -R $dev/support-hours.php $trunk/
cp -R $dev/README.txt $trunk/
cp -R $dev/LICENSE.txt $trunk/
cd $release/tags/
mkdir $releasenumber
echo 'Copy trunk to release dir'
cp -R $trunk/* $release/tags/$releasenumber/
