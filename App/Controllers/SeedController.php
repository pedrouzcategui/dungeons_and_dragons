<?php

namespace App\Controllers;

use App\Models\Chapter;
use App\Models\Dialogue;
use App\Models\DialogueOption;

class SeedController
{
    public function index()
    {

        try {
            //**Chapters */
            // Chapter 1
            Chapter::insert("Escaping prison", "");
            // Chapter 2
            Chapter::insert("The first decision", "");
            // Chapter 3 - Creating a distraction
            Chapter::insert("Creating a distraction", "");
            // Chapter 4 - Praying for change
            Chapter::insert("Praying for change", "");
            // Chapter 5 - Slaying the dragon
            Chapter::insert("Slaying the dragon", "");
            // Chapter 6 - The king's chamber
            Chapter::insert("The king's chamber", "");

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
            Dialogue::insert(FALSE, "Narrator", 1, 2, "Decidiste rendirte, no crees que la libertad vale el sacrificio. Prefieres morir y dejar que la corrupción viva.", FALSE, TRUE);

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
            Dialogue::insert(FALSE, "Soldado", 2, NULL, 'Hey! Eres el prisionero. *grita* Necesito refuerzos!', FALSE, FALSE);

            // #14 - Ir al armamento - Dejar el arma de soldado
            Dialogue::insert(FALSE, "Narrator", 2, NULL, "Oh no, el soldado te ha visto, debes tomar una decisión. ¿Qué harás?", TRUE, FALSE);

            // #15 - Ir al armamento - Dejar el arma de soldado - Asesinar al soldado
            Dialogue::insert(FALSE, "Narrator", 2, 3, "Has asesinado al soldado. Sin embargo, un sentido de culpa te agobia. Sumas 20 de ataque, pero te resta 10 puntos de honor.", FALSE, TRUE);

            // #16 - Ir al armamento - Dejar el arma de soldado - Dejar que huya
            Dialogue::insert(FALSE, "Narrator", 2, 3, "Has dejado que el soldado huya. Te suma 10 puntos de suerte y 20 puntos de honor.", FALSE, TRUE);

            //*Dialogue Options*/
            // Cap 1

            // DialogueOption: Escapar
            DialogueOption::insert(4, "Escapar de prisión", 5);
            // DialogueOption: Quedarte dentro de la celda.
            DialogueOption::insert(4, "Quedarte dentro de la celda", 6);

            // Cap 2

            // Dialogue Option: Ir a la cocina (derecha)
            DialogueOption::insert(7, "Ir a la derecha", 8);
            // Option: Ir al armamento (izquierda)
            DialogueOption::insert(7, "Ir a la izquierda", 11);

            // Dialogue Option: Comer sopa de mariscos
            DialogueOption::insert(8, "Comer sopa de mariscos", 9);
            // Dialogue Option: No comer
            DialogueOption::insert(8, "No comer", 10);

            // Dialogue Option: Tomar el arma de soldado
            DialogueOption::insert(11, "Tomar arma de soldado", 12);
            // Dialogue Option: Dejar el arma de soldado
            DialogueOption::insert(11, "Dejar el arma de soldado", 13);

            // Dialogue Option: Asesinar al soldado
            DialogueOption::insert(14, "Asesinar al soldado", 15);
            // Dialogue Option: Dejar que huya
            DialogueOption::insert(14, "Dejar ir al soldado", 16);


            echo "All Seeded";
        } catch (\Throwable $th) {
            echo $th;
        }




        // Ending 1 - The king is dead, long live the king
        // Ending 2 - The king's bretrayal, the corruption continues.
        // Ending 3 - The {{NAME}}'s corruption.
        // Ending 4 - Dead in prison

    }
}
