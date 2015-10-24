@servers(['web' => 'skysoul1@skysoul.com.au'])

@task('update')
cd public_html/dreamsark.dev
git checkout .
git pull origin master
@endtask

@task('config-git')
git config --global user.email "rafael@skysoul.com.au"
git config --global user.name "Rafael"
@endtask

@task('refresh')
cd public_html/dreamsark.dev
php56s artisan migrate:refresh --seed
@endtask

@task('reset')

    mysql -uskysoul1 -pGH4C=3F6

    drop database skysoul1_dreamsark;
    drop database skysoul1_dreamsark_report;
    drop database skysoul1_dreamsark_translation;

    create database skysoul1_dreamsark;
    create database skysoul1_dreamsark_report;
    create database skysoul1_dreamsark_translation;

    exit;

    cd public_html
    rm -r -f dreamsark.dev
    git clone https://github.com/SkysoulDesign/Dreamsark.git dreamsark.dev
@endtask