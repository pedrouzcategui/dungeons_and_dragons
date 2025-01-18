<?php

namespace App\Controllers;

use App\Database as DB;
use App\Models\Chapter;
use App\Models\Dialogue;
use App\Models\DialogueOption;
use App\Models\DialogueDiceThrow;
use App\Models\Ending;
use App\Response;

class SeedController
{
    public function index()
    {

        try {
            //**Chapters */
            // Chapter 1
            Chapter::insert("Escaping prison", "", "chapter-1.webp", "chapter_1.mp3");
            // Chapter 2
            Chapter::insert("The first decision", "", "chapter-2.webp", "chapter_2.mp3");
            // Chapter 3 - Creating a distraction
            Chapter::insert("Creating a distraction", "", "chapter-3.webp", "chapter_3.mp3");
            // Chapter 4 - Praying for change
            Chapter::insert("Praying for change", "", "chapter-4.webp", "chapter_4.mp3");
            // Chapter 5 - The king's chamber
            Chapter::insert("The king's chamber", "", "chapter-5.webp", "chapter_5.mp3");

            //**Endings */
            // Ending 1 - Dead in prison
            Ending::insert("Morir en prisión", "Decidiste que no vale la pena liberar al reino de la corrupción del rey. Mueres 3 días luego de estar en prisión.", "ending-1.webp");
            // Ending 2 - Planned Execution
            Ending::insert("Surrender", "Te has rendido frente a los guardias, y tu ejecución ha sido adelantada.", "ending-2.webp");
            // Ending 3 - Dead by soliders
            Ending::insert("Death by soldiers", "Te han asesinado, no contaste con mucha suerte.", "ending-3.webp");
            // Ending 4 - Happy Kingdom
            Ending::insert("Happy Kingdom", "Lo lograste! Liberaste al reino de la corrupcion del rey Orudam!", "ending-4.webp");
            // Ending 5 - Corrupted Kingdom
            Ending::insert("Corrupted Kingdom", "El rey y tu han unido fuerzas para gobernar el reino, sin embargo, eres asesinado a los meses por el mismo rey.", "ending-5.webp");
            // Ending 6 - Corruption continues
            Ending::insert("The king won", "El rey te asesino y siguio con su reino.", "ending-6.webp");

            //**Dialogues */
            // #1
            Dialogue::insert(FALSE, "Narrator", 1, NULL, "Eres {{NAME}}, un habil {{CLASE}}, cuyo propósito era servir y proteger al reino de Datrebil, governado por el rey Orudam. Sin embargo, luego de muchos años de servicio, te has dado cuenta que el rey ha devastado a la población en favor de enriquecer sus bolsillos.", FALSE, FALSE);

            // #2
            Dialogue::insert(FALSE, "Narrator", 1, NULL, "Eres una persona muy honesta, y valiente. No toleras el maltrato ni la injusticia, así que decidiste hacer algo que cambiaría tu vida para siempre: Revelarte en contra del rey.", FALSE, FALSE);

            // #3
            Dialogue::insert(FALSE, "Narrator", 1, NULL, "Sin embargo, tu estrategia no fué exitosa, y eres capturado por 'traición'. Ahora, debes tomar una serie de decisiones que pondrán en juego el reino de Datrebil.", FALSE, FALSE);

            // #4
            Dialogue::insert(FALSE, "Narrator", 1, NULL, "Despiertas en prisión, no sabes que está pasando, solamente escuchas a gente celebrando desde la celda. Sin embargo, para tu sorpresa, la celda está abierta. Puedes elegir escapar, o puedes elegir quedarte dentro de la celda. ¿Qué quieres hacer?", TRUE, FALSE);

            // #5
            Dialogue::insert(FALSE, "Narrator", 1, 2, "Elegiste escapar. Excelente, nadie logró verte, para tu sorpresa, nadie estaba cerca para ver tu magnífica huída!", FALSE, TRUE);

            // #6
            Dialogue::insert(FALSE, "Narrator", 1, 2, "Decidiste rendirte, no crees que la libertad vale el sacrificio. Prefieres morir y dejar que la corrupción viva.", FALSE, TRUE, TRUE, 1);

            // Chapter 2

            // #7
            Dialogue::insert(FALSE, "Narrator", 2, NULL, "Hay dos caminos, uno hacia la izquierda que está obscuro, y otro hacia la derecha, que se ve mucho más amigable. ¿Hacia donde decides ir?", TRUE, FALSE);

            // #8 - Ir a la cocina
            Dialogue::insert(FALSE, "Narrator", 2, NULL, "Llegas a la cocina. Encuentras una deliciosa sopa de mariscos! ¿Quieres comertela?", TRUE, FALSE);

            // #9 - Ir a la cocina - Comer sopa de mariscos
            Dialogue::insert(FALSE, "Narrator", 2, 3, "La sopa de mariscos estaba deliciosa. Has ganado 20 puntos de vida", FALSE, TRUE);

            // #10 - Ir a la cocina - No comer
            Dialogue::insert(FALSE, "Narrator", 2, 3, "Llevas mucho tiempo en prisión, y al decidir no comer, te restas 10 puntos de vida", FALSE, TRUE);

            // #11 - Ir al armamento
            Dialogue::insert(FALSE, "Narrator", 2, NULL, "Entras al armamento, y encuentras una {{ARMA DE CLASE}} de soldado, ¿qué decides hacer?", TRUE, FALSE);

            // #12 - Ir al armamento - Tomar el arma de soldado
            Dialogue::insert(FALSE, "Narrator", 2, 3, "Eliges tomar el arma de soldado. Te suma 20 puntos de ataque.", FALSE, TRUE);

            // #13 - Ir al armamento - Dejar el arma de soldado
            Dialogue::insert(TRUE, "Soldado", 2, NULL, 'Hey! Eres el prisionero. *grita* Necesito refuerzos!', FALSE, FALSE);

            // #14 - Ir al armamento - Dejar el arma de soldado
            Dialogue::insert(FALSE, "Narrator", 2, NULL, "Oh no, el soldado te ha visto, debes tomar una decisión. ¿Qué harás?", TRUE, FALSE);

            // #15 - Ir al armamento - Dejar el arma de soldado - Asesinar al soldado
            Dialogue::insert(FALSE, "Narrator", 2, 3, "Has asesinado al soldado. Sin embargo, un sentido de culpa te agobia. Sumas 20 de ataque, pero te resta 10 puntos de honor.", FALSE, TRUE);

            // #16 - Ir al armamento - Dejar el arma de soldado - Dejar que huya
            Dialogue::insert(FALSE, "Narrator", 2, 3, "Has dejado que el soldado huya. Te suma 10 puntos de suerte y 20 puntos de honor.", FALSE, TRUE);

            // Chapter 3
            // #17
            Dialogue::insert(FALSE, "Narrator", 3, NULL, "Muy bien, te las arreglaste para llegar a la sala central del castillo. Sin embargo, hay 4 guardias que están cubriendo las escaleras del castillo, las cuales debes subir. ¿Qué decides hacer?", TRUE, FALSE);

            // Lanzar una piedra para distraerlos (tirada de dados)-> #18
            // Enfrentarte a ellos (tirada de dados) -> #21

            // Lanzar una piedra para distraerlos (tirada de dados)
            // #18
            Dialogue::insert(FALSE, "Narrator", 3, NULL, "Decides lanzar una piedra. Lanza el dado y obtén más de 8 para avanzar.", FALSE, FALSE, FALSE, NULL, TRUE, FALSE);

            // #19 - Lanzar una piedra (exitoso)
            Dialogue::insert(FALSE, "Narrator", 3, 4, "Tu piedra creo una buena distracción! Lograste distraer a los guardias y llegaste a la iglesia.", FALSE, TRUE);

            // #20 - Lanzar una piedra (fallido)
            Dialogue::insert(FALSE, "Narrator", 3, NULL, "Oh no, tu distracción no funcionó, los guardias te encontraron. ¿Que harás?", TRUE, FALSE);

            // Pelear (tirada de dados)
            // Rendirse (bad ending)

            // #21 Pelear (tirada de dados)
            Dialogue::insert(FALSE, "Narrator", 3, NULL, "Decides pelear con los soldados, debes obtener más de 10 para avanzar.", FALSE, FALSE, FALSE, NULL, TRUE, FALSE);

            // #22 - Lanzar una piedra (fallido) - Pelear (exito)
            Dialogue::insert(FALSE, "Narrator", 3, 4, "Lograste acabar con los guardias! Eres muy hábil, has obtenido una armadura que te incrementa la defensa por 100 puntos, y has conseguido un {{ARMA DE CLASE}} que aumenta tu ataque por 100 puntos!", FALSE, TRUE);

            // #23 - Lanzar una piedra (fallido) - Pelear (fallido)
            Dialogue::insert(FALSE, "Narrator", 3, 4, "No puedes pelear más, has sido herido, te han quitado 50 puntos de vida. Pero logras llegar a la iglesia.", FALSE, TRUE);

            // #24 - Lanzar una piedra (fallido) - Rendirse (ENDING 2)
            Dialogue::insert(FALSE, "Narrator", 3, NULL, "Te rendiste, y tu ejecución fue movida para hoy. Estás en la guillotina, mirando a la luz del sol, y de repente, todo se ve negro.", FALSE, TRUE, TRUE, 2);

            // #25 - Enfrentarse a ellos (dice throw)
            Dialogue::insert(FALSE, "Narrator", 3, NULL, "Decides enfrentarte a ellos, pero necesitas mucha suerte para vencerlos, debes obtener un 15 o más para tener éxito.", FALSE, FALSE, FALSE, NULL, TRUE, FALSE);

            // #26 - Enfrentarse a ellos (dice successful)
            Dialogue::insert(FALSE, "Narrator", 3, 4, "Lograste vencerlos a todos, tu honor y tu defensa han aumentado por 50 puntos", FALSE, TRUE);

            // #27 - Enfrentarse a ellos (dice incorrect) (Ending 3)
            Dialogue::insert(FALSE, "Narrator", 3, NULL, "Acabas de ser asesinado, no contaste con mucha suerte.", FALSE, TRUE, TRUE, 3);

            //Chapter 4
            // #28
            Dialogue::insert(FALSE, "Narrator", 4, NULL, "Llegaste a la iglesia, está solo, y decides sentarte a descansar. Juntas tus manos y empiezas a rezar. ¿De qué se trata tu plegaria?", TRUE, FALSE);

            // Pedir más justicia
            // Pedir más fuerza
            // Pedir más misericordia
            // Pedir perdón

            // #29 - Pedir Justicia
            Dialogue::insert(FALSE, "Narrator", 4, 5, "Rezaste por justicia, tus puntos de vida y de defensa han aumentado por 20 puntos cada uno", FALSE, TRUE);

            // #30 - Pedir Fuerza
            Dialogue::insert(FALSE, "Narrator", 4, 5, "Rezaste por Fuerza, tus puntos de ataque y honor han aumentado por 20 puntos cada uno", FALSE, TRUE);

            // #31 - Pedir Misericordia
            Dialogue::insert(FALSE, "Narrator", 4, 5, "Rezaste por misericordia, tus puntos de vida y ataque han sido incrementados por 30 puntos cada uno", FALSE, TRUE);

            // #32 - Pedir Perdon
            Dialogue::insert(FALSE, "Narrator", 4, 5, "Rezaste por perdón. Dios te mira desde el cielo y te ha bendecido con una armadura celestial. Tus puntos de vida, defensa, y ataque, aumentan por 100 cada uno.", FALSE, TRUE);

            //Chapter 5
            // #33
            Dialogue::insert(TRUE, "Rey", 5, NULL, "Miren quién es... {{NAME}}... Acabas de cometer un error al venir acá.", FALSE, FALSE);

            // #34
            Dialogue::insert(TRUE, "Rey", 5, NULL, "Verás, ser Rey no es fácil. A veces debes tomar decisiones que te llevarán a cometer actos atroces.", FALSE, FALSE);

            // #35
            Dialogue::insert(TRUE, "Rey", 5, NULL, "Pero NADIE te felicita por las cosas que haces. Todo el mundo quiere vivir bien, todo el mundo quiere cosas, pero NADIE se preocupa por hacer algo y lograrlo. Ahora, porque yo logro las cosas, acaso no me merezco ser recompensado?", TRUE, FALSE);

            // No, porque debes hacer las cosas que sean mejores para el reino, no para tu bolsillo. -> 34
            // ... -> 38

            // #36 - No Empathy
            Dialogue::insert(TRUE, "Rey", 5, NULL, "Estás en el lado incorrecto de la historia, {{NAME}}. Nunca entenderás que no hay paz sin violencia. Te estoy dando la oportunidad para que tengas la vida que deseas, para que tengas todos los lujos que deseas... ¿Acaso no lo quieres?", TRUE, FALSE);

            // Ni muerto -> 35
            // .... -> 

            // #37 - No Empathy - Ni Muerto (dice throw)
            Dialogue::insert(TRUE, "Rey", 5, NULL, "No me quedará otra cosa que hacer. Muere!", FALSE, FALSE);

            // #38 - No Empathy - Ni Muerto (dice throw) (exito)
            Dialogue::insert(TRUE, "Rey", 5, NULL, "No... como es posible... un tonto {{CLASE}} no puede matarme... *cough* *cough*...", FALSE, FALSE);

            // #39 - Lo lograste, has asesinado al rey
            Dialogue::insert(TRUE, "Narrator", 5, NULL, "Lo lograste, has asesinado al rey!!!", FALSE, FALSE, TRUE, 4);

            // Ending 4: Happy Kingdom

            // #40 ...
            Dialogue::insert(FALSE, "Rey", 5, NULL, "Piensalo, {{NAME}}, no te quise encerrar, eres de mis mejores soldados. Entiendo que quieras darle todas las riquezas a todas las personas. Pero no todos hacen el mismo sacrificio que tu para poder llevar el pan a su casa. Piensa en todas las cosas maravillosas que podrias tener.", FALSE, FALSE);

            // No, esto no esta bien.
            // Majestad, pido disculpas por haber pensado erronamente de usted

            // - No Empathy - ... - Not correct (go to node of no empathy)
            // GOTO dialogue #

            // #41 - No Empathy - ... - Forgiveness
            Dialogue::insert(FALSE, "Rey", 5, NULL, "Nuestro imperio será increíble {{NAME}}.", FALSE, TRUE, TRUE, 5);

            // Ending 3 Corruption

            // #42 - No Empathy - Ni Muerto (dice throw) (fallido)
            Dialogue::insert(FALSE, "Rey", 5, NULL, "No tuviste que haber venido, {{NAME}}.", FALSE, FALSE);

            // #43 - No Empathy - Ni Muerto (dice throw) (fallido)
            Dialogue::insert(FALSE, "Rey", 5, NULL, "El rey te ha apuñalado en el estomago, estás sangrando demasiado, no puedes levantarte... es el fin... el rey logró derrotarte.", FALSE, FALSE, TRUE, 6);

            // Ending 4: Corruption continues

            //*Dialogue Options*/
            // Cap 1

            // DialogueOption: Escapar
            DialogueOption::insert(4, "Escapar de prisión", 5);
            // DialogueOption: Quedarte dentro de la celda.
            DialogueOption::insert(4, "Quedarte dentro de la celda", 6);

            // Cap 2
            DialogueOption::insert(7, "Ir a la derecha", 8);
            DialogueOption::insert(7, "Ir a la izquierda", 11);

            DialogueOption::insert(8, "Comer sopa de mariscos", 9);
            DialogueOption::insert(8, "No comer", 10);

            DialogueOption::insert(11, "Tomar arma de soldado", 12);
            DialogueOption::insert(11, "Dejar el arma de soldado", 13);

            DialogueOption::insert(14, "Asesinar al soldado", 15);
            DialogueOption::insert(14, "Dejar ir al soldado", 16);

            // Cap 3 (dice mechanics start here)
            DialogueOption::insert(17, "Lanzar una piedra para distraerlos", 18);
            DialogueOption::insert(17, "Enfrentarte a ellos", 25);

            DialogueOption::insert(20, "Pelear", 21);
            DialogueOption::insert(20, "Rendirse", 24);

            // Cap 4
            DialogueOption::insert(28, "Justicia", 29);
            DialogueOption::insert(28, "Fuerza", 30);
            DialogueOption::insert(28, "Misericordia", 31);
            DialogueOption::insert(28, "Perdon", 32);

            // Cap 5 
            DialogueOption::insert(35, "No, tu deber es mejorar el reino, no tu propia riqueza.", 36);
            DialogueOption::insert(35, "...", 40);

            DialogueOption::insert(36, "Ni muerto.", 37);
            DialogueOption::insert(36, "...", 40);

            DialogueOption::insert(40, "No, esto no esta bien", 42);
            DialogueOption::insert(40, "Tiene razon, mi rey.", 41);

            // Dialogue Dice Throws
            // #20 - Lanzar una piedra
            DialogueDiceThrow::insert(18, 8, 19, 20);

            // #21 - Lanzar una piedra (fallido) -> Pelear con guardias/soldados
            DialogueDiceThrow::insert(21, 10, 22, 23);

            // #25 - Enfrentarse a ellos
            DialogueDiceThrow::insert(25, 15, 26, 27);


            echo "All Seeded";
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function destroy()
    {
        try {
            DB::query("DROP DATABASE IF EXISTS dungeons_and_dragons");
            echo "All Destroyed";
        } catch (\Throwable $th) {
            Response::error($th);
        }
    }
}
