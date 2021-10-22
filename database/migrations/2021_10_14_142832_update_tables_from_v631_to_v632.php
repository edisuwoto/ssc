<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\SmLanguagePhrase;

class UpdateTablesFromV631ToV632 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $setNulls =
        [  
            " SET FOREIGN_KEY_CHECKS=0 ",
            "ALTER TABLE sm_students CHANGE class_id class_id INT(10) UNSIGNED NULL",
            "ALTER TABLE sm_students CHANGE section_id section_id INT(10) UNSIGNED NULL",
            "ALTER TABLE sm_students CHANGE session_id session_id INT(10) UNSIGNED NULL",
            "ALTER TABLE sm_students CHANGE role_id role_id INT(10) UNSIGNED NULL",

            "ALTER TABLE sm_marks_grades CHANGE academic_id academic_id INT(10) UNSIGNED NULL DEFAULT NULL;",

            "ALTER TABLE sm_email_settings CHANGE academic_id academic_id INT(10) UNSIGNED NULL DEFAULT NULL;",
            "ALTER TABLE sm_email_settings DROP FOREIGN KEY sm_email_settings_academic_id_foreign;",
            "ALTER TABLE sm_email_settings ADD CONSTRAINT sm_email_settings_academic_id_foreign FOREIGN KEY (academic_id) REFERENCES sm_academic_years(id) ON DELETE SET NULL ON UPDATE RESTRICT;",
            
            "ALTER TABLE sm_marks_grades CHANGE gpa gpa FLOAT(11) NULL DEFAULT NULL;",
            "ALTER TABLE sm_temporary_meritlists CHANGE total_marks total_marks INT NULL DEFAULT NULL;",
            "ALTER TABLE sm_general_settings CHANGE academic_id academic_id INT(10) UNSIGNED NULL DEFAULT NULL;",
            "ALTER TABLE sm_general_settings DROP FOREIGN KEY sm_general_settings_academic_id_foreign;",
            "ALTER TABLE sm_general_settings ADD CONSTRAINT sm_general_settings_academic_id_foreign FOREIGN KEY (academic_id) REFERENCES sm_academic_years(id) ON DELETE SET NULL ON UPDATE RESTRICT;",
            "ALTER TABLE sm_general_settings DROP FOREIGN KEY sm_general_settings_date_format_id_foreign; ",
            "ALTER TABLE sm_general_settings ADD CONSTRAINT sm_general_settings_date_format_id_foreign FOREIGN KEY (date_format_id) REFERENCES sm_date_formats(id) ON DELETE SET NULL ON UPDATE RESTRICT;",
            "ALTER TABLE sm_general_settings DROP FOREIGN KEY sm_general_settings_language_id_foreign;",
            "ALTER TABLE sm_general_settings ADD CONSTRAINT sm_general_settings_language_id_foreign FOREIGN KEY (language_id) REFERENCES sm_languages(id) ON DELETE SET NULL ON UPDATE RESTRICT;",
            "ALTER TABLE sm_general_settings DROP FOREIGN KEY sm_general_settings_session_id_foreign;",
            "ALTER TABLE sm_general_settings ADD CONSTRAINT sm_general_settings_session_id_foreign FOREIGN KEY (session_id) REFERENCES sm_academic_years(id) ON DELETE SET NULL ON UPDATE RESTRICT;",

            " ALTER TABLE sm_students DROP FOREIGN KEY sm_students_bloodgroup_id_foreign ",
            " ALTER TABLE sm_students ADD CONSTRAINT sm_students_bloodgroup_id_foreign FOREIGN KEY (bloodgroup_id) REFERENCES sm_base_setups(id) ON DELETE SET NULL ON UPDATE RESTRICT ",
            " ALTER TABLE sm_students DROP FOREIGN KEY sm_students_class_id_foreign ",
            " ALTER TABLE sm_students ADD CONSTRAINT sm_students_class_id_foreign FOREIGN KEY (class_id) REFERENCES sm_classes(id) ON DELETE SET NULL ON UPDATE RESTRICT ",
            " ALTER TABLE sm_students DROP FOREIGN KEY sm_students_dormitory_id_foreign ",
            " ALTER TABLE sm_students ADD CONSTRAINT sm_students_dormitory_id_foreign FOREIGN KEY (dormitory_id) REFERENCES sm_dormitory_lists(id) ON DELETE SET NULL ON UPDATE RESTRICT ",
            " ALTER TABLE sm_students DROP FOREIGN KEY sm_students_gender_id_foreign ",
            " ALTER TABLE sm_students ADD CONSTRAINT sm_students_gender_id_foreign FOREIGN KEY (gender_id) REFERENCES sm_base_setups(id) ON DELETE SET NULL ON UPDATE RESTRICT ",
            " ALTER TABLE sm_students DROP FOREIGN KEY sm_students_religion_id_foreign ",
            " ALTER TABLE sm_students ADD CONSTRAINT sm_students_religion_id_foreign FOREIGN KEY (religion_id) REFERENCES sm_base_setups(id) ON DELETE SET NULL ON UPDATE RESTRICT ",
            " ALTER TABLE sm_students DROP FOREIGN KEY sm_students_room_id_foreign ",
            " ALTER TABLE sm_students ADD CONSTRAINT sm_students_room_id_foreign FOREIGN KEY (room_id) REFERENCES sm_room_lists(id) ON DELETE SET NULL ON UPDATE RESTRICT ",
            " ALTER TABLE sm_students DROP FOREIGN KEY sm_students_route_list_id_foreign ",
            " ALTER TABLE sm_students ADD CONSTRAINT sm_students_route_list_id_foreign FOREIGN KEY (route_list_id) REFERENCES sm_routes(id) ON DELETE SET NULL ON UPDATE RESTRICT ",
            " ALTER TABLE sm_students DROP FOREIGN KEY sm_students_section_id_foreign ",
            " ALTER TABLE sm_students ADD CONSTRAINT sm_students_section_id_foreign FOREIGN KEY (section_id) REFERENCES sm_sections(id) ON DELETE SET NULL ON UPDATE RESTRICT ",
            " ALTER TABLE sm_students DROP FOREIGN KEY sm_students_session_id_foreign ",
            " ALTER TABLE sm_students ADD CONSTRAINT sm_students_session_id_foreign FOREIGN KEY (session_id) REFERENCES sm_academic_years(id) ON DELETE SET NULL ON UPDATE RESTRICT ",
            " ALTER TABLE sm_students DROP FOREIGN KEY sm_students_student_category_id_foreign ",
            " ALTER TABLE sm_students ADD CONSTRAINT sm_students_student_category_id_foreign FOREIGN KEY (student_category_id) REFERENCES sm_student_categories(id) ON DELETE SET NULL ON UPDATE RESTRICT ",
            " ALTER TABLE sm_students DROP FOREIGN KEY sm_students_student_group_id_foreign ",
            " ALTER TABLE sm_students ADD CONSTRAINT sm_students_student_group_id_foreign FOREIGN KEY (student_group_id) REFERENCES sm_student_groups(id) ON DELETE SET NULL ON UPDATE RESTRICT ",
            " ALTER TABLE sm_students DROP FOREIGN KEY sm_students_vechile_id_foreign ",
            " ALTER TABLE sm_students ADD CONSTRAINT sm_students_vechile_id_foreign FOREIGN KEY (vechile_id) REFERENCES sm_vehicles(id) ON DELETE SET NULL ON UPDATE RESTRICT ",

             " ALTER TABLE sm_students DROP FOREIGN KEY sm_students_academic_id_foreign ",
            " ALTER TABLE sm_students ADD CONSTRAINT sm_students_academic_id_foreign FOREIGN KEY (academic_id) REFERENCES sm_academic_years(id) ON DELETE SET NULL ON UPDATE RESTRICT ",

            " SET FOREIGN_KEY_CHECKS =1 ",
        ];

        foreach($setNulls as $setNull){
            DB::statement($setNull);
        }

        $d = [
         [19, 'No Result found', 'No Result found', 'No se han encontrado resultados', 'কোন ফলাফল পাওয়া যায়নি', 'Aucun résultat trouvé'],
            [19, 'Your result is not published yet.', 'Your result is not published yet.', 'Tu resultado aún no está publicado.', 'আপনার রেজাল্ট এখনো প্রকাশিত হয়নি।', 'Votre résultat nest pas encore publié.'],
            [19, 'Your result publication date is:', 'Your result publication date is:', 'La fecha de publicación de su resultado es:', 'আপনার ফলাফল প্রকাশের তারিখ হল:', 'La date de publication de vos résultats est :'],
            [19, 'using', 'utilizando', 'Coma', 'ব্যবহার', 'à laide de'],
        ];

        foreach ($d as $row) {
            $s = new SmLanguagePhrase();
            $s->modules = $row[0];
            $s->default_phrases = trim($row[1]);
            $s->en = trim($row[2]);
            $s->es = trim($row[3]);
            $s->bn = trim($row[4]);
            $s->fr = trim($row[5]);
            $s->save();
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
