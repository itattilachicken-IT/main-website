<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Investor Handbook — Attila Chicken</title>

    @vite('resources/css/app2.css')
    @vite('resources/js/app2.js')
</head>

<body>

<div class="dashboard-layout">

    {{-- Sidebar --}}
    @include('partials.header')

    {{-- Main Content --}}
    <main class="main-content">
        @include('partials.topbar')

        <section class="section">
            <div class="container">

               {{-- Notice --}}
                <div class="card" style="margin-bottom: 24px;">
                    <p class="lead">
                        See our investor handbook for a comprehensive guide to investing with Attila Chicken, including eligibility, how investments work, returns, risks, legal information, and FAQs.
                       
                    </p>
                </div>

                <div class="handbook-layout">
                  

                    {{-- Side Navigation --}}
                    <aside class="handbook-nav">
                        <a href="#" data-section="overview" class="nav-link2 actived">Overview</a>
                        <a href="#" data-section="eligibility" class="nav-link2">Eligibility</a>
                        <a href="#" data-section="how" class="nav-link2">How Investments Work</a>
                        <a href="#" data-section="returns" class="nav-link2">Returns</a>
                        <a href="#" data-section="risks" class="nav-link2">Risks</a>
                        <a href="#" data-section="legal" class="nav-link2">Legal</a>
                        <a href="#" data-section="dispute" class="nav-link2">Dispute Resolution</a>
                        <a href="#" data-section="faq" class="nav-link2">FAQs</a>
                    </aside>

                    {{-- Content --}}
                    <div class="handbook-content">

                        <div id="overview" class="handbook-section actived">
                            <h3>Overview</h3>
                            <p>
                                Attila Poultry Farm offers structured poultry investment partnerships in which investors provide capital for the acquisition of day-old chicks, feed, and related operational inputs, while the company manages all aspects of poultry production, including housing, care, and sale of mature birds. Through this arrangement, investors participate in the profits generated from the poultry project without being involved in daily farm operations. Each investment package is designed to operate as a complete production cycle and includes insurance coverage for the flock to reduce exposure to unforeseen losses. The partnership is governed by a formal agreement that outlines responsibilities, payment schedules, and legal protections for both parties.
                            </p>
                        </div>

                        <div id="eligibility" class="handbook-section">
                            <h3>Eligibility</h3>
                            <p>
                                To qualify for participation, an investor must provide 
                                valid identification documents, including a <strong>National ID</strong> or <strong>Passport</strong>, 
                                a <strong>KRA PIN</strong> certificate, and a recent <strong>passport-size photograph</strong>. 
                                Investors are also required to submit accurate <strong>contact information</strong>, <strong>next-of-kin </strong> details, 
                                and valid <strong>bank account</strong> information for payment processing. 
                                In addition, all participants must comply with <strong>Know Your Customer (KYC)</strong> and <strong>Anti-Money Laundering (AML)</strong> regulations as 
                                required by law. The investor must further undertake to obtain <strong>poultry insurance</strong> coverage for the invested birds within seven days 
                                of executing the agreement, ensuring that the investment is properly safeguarded against potential operational risks.
                            </p>
                        </div>

                        <div id="how" class="handbook-section">
                            <h3>How Investments Work</h3>
                            <p>
                                Investments operate through a structured process beginning with the selection of a specific package based on the investor’s capital capacity. The investor transfers funds to Attila Poultry Farm, which then uses the capital to procure day-old chicks, feed, and other necessary inputs. Attila assumes full responsibility for managing the poultry production cycle, including husbandry, maintenance of facilities, and eventual sale of the birds upon maturity. Once sales are completed, profits are distributed to the investor according to a predetermined schedule. Payments are typically made at regular intervals of approximately forty-five days after placement, and investors may choose to reinvest their returns into subsequent production cycles to compound earnings.
                            </p>
                        </div>

                        <div id="returns" class="handbook-section">
                            <h3>Returns</h3>
                            <p>
                                1.	The Investor will receive a profit payment of Kenya Shillings Thirty (Kshs. 30.00) per chick for the initial number of birds. Every profit payout will occur after 45 days from the date of placement, in accordance with the agreed-upon schedule.
                              <br><br>  2.	For each payment under the agreed schedule, the customer is obligated to provide an ETIMS receipt on or before the payment date. This ensures transparency, verification, and adherence to agreed financial protocols.
                            <br><br> 3.	For a re-investment, the base Attila, will do the re-placement of chickens within two weeks after selling the chickens with 45 days.

                            </p>
                        </div>

                        <div id="risks" class="handbook-section">
                            <h3>Risks</h3>
                            <p>
                                Although the investment is supported by insurance coverage, certain risks inherent to agricultural operations remain. These include disease outbreaks affecting poultry, fluctuations in market prices for poultry products, operational disruptions, environmental factors, and events beyond the control of either party, such as natural disasters or other force majeure circumstances. While insurance helps mitigate losses related to mortality of the birds, investors should understand that agricultural ventures may still experience delays or performance variations due to these factors.
                            </p>
                        </div>

                        <div id="legal" class="handbook-section">
                            <h3>Legal</h3>
                            <p>
                                The investment partnership is governed by a formal contract in accordance with the laws of the Republic of Kenya. Both parties are required to comply with applicable regulations, including anti-money laundering and anti-corruption laws. Confidential information exchanged during the partnership must be protected and used solely for purposes related to the agreement. All intellectual property associated with Attila Poultry Farm, including its brand and operational systems, remains the exclusive property of the company. The contract typically runs for a specified period, subject to fulfillment of payment obligations, and any amendments must be documented in writing and signed by both parties.
                            </p>
                        </div>

                        <div id="dispute" class="handbook-section">
                            <h3>Dispute Resolution</h3>
                            <p>
                                1.	Should any dispute arise between the Parties hereto with regard to the interpretation, rights, obligations and/or implementation of any one or more of the provisions of this Agreement, the Parties to such dispute shall in the first instance attempt to resolve such dispute by amicable negotiation. Should such negotiations fail to achieve a resolution within fifteen (15) days, either Party may declare a dispute by written notification to the other, whereupon such dispute shall be referred to.
                               <br> <br>2.	Should any dispute arise between the Parties hereto with regard to the interpretation, rights, obligations and/or implementation of any one or more of the provisions of this Agreement, the Parties to such dispute shall in the first instance attempt to resolve such dispute by amicable negotiation. Should such negotiations fail to achieve a resolution within thirty (30) days, either Party may declare a dispute by written notification to the other, whereupon such dispute shall be referred to mediation.
                             <br> <br>  3.	If the mediation process does not result in an agreement within twenty-one (21) days of commencement of the said mediation, either Party may refer the matter to arbitration under the following terms parties will be at liberty to apply.
                             <br> <br>  4.	The arbitration shall be conducted by a single arbitrator who shall be an advocate of not less than fifteen (15) years standing to be agreed upon between the Parties failing which such arbitrator shall be appointed by the chairperson of the Chartered Institute of Arbitrators.
                              <br><br>  5.	The place and seat of arbitration shall be Nairobi and the language of arbitration shall be English.
                             <br>  <br> 6.	The arbitration shall be conducted in accordance with the Rules of Arbitration of the Kenya Chapter of the Chartered Institute of Arbitrators and subject to and in accordance with the provisions of the Arbitration Act, 1995 (as amended).
                            <br> <br>   7.	The award of the arbitration tribunal shall be final and binding upon the Parties to the extent permitted by law and any Party may apply to a court of competent jurisdiction for enforcement of such award. The award of the arbitration tribunal may take the form of an order to pay an amount or to perform or to prohibit certain activities; and
                            <br><br>    8.	Notwithstanding the foregoing, any party is entitled to seek preliminary injunctive relief or interim conservatory order from any court of competent jurisdiction pending the final decision of or award of the arbitrator.

                            </p>
                        </div>

                        <div id="faq" class="handbook-section">
                            <h3>FAQs</h3>
                                            <p><strong>Q: How often are returns paid?</strong><br>
                A: Returns are paid in six scheduled cycles, approximately every 45 days.</p>

                <p><strong>Q: Is the investment insured?</strong><br>
                A: Yes. Investors are required to purchase poultry insurance covering the invested birds.</p>

                <p><strong>Q: Who manages the farm operations?</strong><br>
                A: Attila Poultry Farm handles all operational activities.</p>

                <p><strong>Q: Can I reinvest my returns?</strong><br>
                A: Yes. Reinvestment into new production cycles is permitted.</p>

                <p><strong>Q: How are payments made?</strong><br>
                A: Payments are made via bank transfer to the investor’s designated account.</p>

                <p><strong>Q: Can the contract be terminated early?</strong><br>
                A: Yes, subject to written notice and the terms outlined in the agreement.</p>
                            
                        </div>

                    </div>
                </div>

            </div>
        </section>

    </main>

</div>



</body>
</html>
<script></script>