<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    private $data = [
        [
            'question' => 'How can you print a document from your laptop at HZ?',
            'answer' => 'Log in using your username and password on the <a target="_blank" href="https://hz.mynetpay.nl/Login">HZ website</a>. If you need to add more files, repeat the process by clicking Choose File and selecting the additional files you want to print. When you have selected every document, check the Advanced box to choose whether you want black-and-white or double-sided printing. Select either the "HZ printer" or "HZ plotter". You must use your HZ pass to sign in on the TouchID next to the multifunction printer and choose "Print" after requesting a print. Choose the printer you want to print to from the options. Only if your printing account has adequate credit will the print job be finished. When everything is finished, select "Logout" and then "Stop" on the TouchID.',
            'link' => ''
        ],
        [
            'question' => 'How can you scan a document and send it to your laptop at HZ?',
            'answer' => 'Although scanning is free, you must have at least €0.07 of credit on your HZ pass to start the process.
        On the TouchID next to the multifunction printer, sign in using your HZ pass. The "Scanning - Scan" option can be found in the TouchID menu. Place the original sheet on the glass plate or feeder. Input "Scan and Send" -> "Scan to me" -> "Yes" -> "Start button". Select "Start Sending" after this is ready. When everything is finished, select "Logout" and then "Stop" on the TouchID.',
            'link' => ''
        ],
        [
            'question' => 'How can I buy something (like when I sign up for the IT introduction event) on the HZ web shop?',
            'answer' => 'Visit the <a target="_blank"
                                        href="https://webshop.hz.nl/webshopapp/default.aspx?menu=082076044027019251066025111065201099237062130097">HZ
                webshop</a>, choose your preferred item, place your purchase, head to your shopping
            basket, and proceed to the checkout!',
            'link' => ''
        ],
        [
            'question' => 'How can you book a project space in one of the wings?',
            'answer' => 'Click "Make a reservation" or "Reserve a room" on the <a target="_blank"
                                                                                    href="https://hz.mynetpay.nl/Login">Selfservice portal</a>. Choose
            the room you want to reserve and check the potential window of availability.',
            'link' => ''
        ],
        [
            'question' => 'What are the instructions if you want to park your car at the HZ parking lot?',
            'answer' => 'You can park in the university lot after showing the barriers your HZ pass.',
            'link' => ''
        ]
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->data as $item) {
            Faq::create($item);
        }
    }
}
