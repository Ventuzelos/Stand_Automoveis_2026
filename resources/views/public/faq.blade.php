@extends('public.layouts.app')

@section('title', 'UrbanMotors - FAQ')
@section('metaDescription', 'Perguntas frequentes sobre compra de viaturas, financiamento, garantia e contacto com a UrbanMotors.')

@section('content')
    <section class="contact-hero">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-8">
                    <span class="section-kicker">FAQ</span>

                    <h1 class="section-title mb-3">
                        Perguntas frequentes.
                    </h1>

                    <p class="section-text mb-0">
                        Encontre respostas rápidas sobre viaturas, disponibilidade, financiamento,
                        garantias e pedidos de contacto.
                    </p>
                </div>

                <div class="col-lg-4">
                    <div class="contact-hero-card">
                        <i class="bi bi-question-circle"></i>
                        <div>
                            <strong>Dúvidas comuns</strong>
                            <span>Informação clara antes da compra</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="contact-form-card">
                <div class="card-body p-4 p-lg-5">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="faqOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faqCollapseOne" aria-expanded="true"
                                    aria-controls="faqCollapseOne">
                                    Como posso pedir informações sobre uma viatura?
                                </button>
                            </h3>

                            <div id="faqCollapseOne" class="accordion-collapse collapse show"
                                aria-labelledby="faqOne" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Pode utilizar a página de contactos para enviar uma mensagem com o modelo da viatura
                                    pretendida. A equipa comercial entrará em contacto assim que possível.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h3 class="accordion-header" id="faqTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faqCollapseTwo" aria-expanded="false"
                                    aria-controls="faqCollapseTwo">
                                    As viaturas têm garantia?
                                </button>
                            </h3>

                            <div id="faqCollapseTwo" class="accordion-collapse collapse"
                                aria-labelledby="faqTwo" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Sim. As viaturas comercializadas seguem as condições de garantia aplicáveis,
                                    de acordo com a legislação em vigor e as características de cada viatura.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h3 class="accordion-header" id="faqThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faqCollapseThree" aria-expanded="false"
                                    aria-controls="faqCollapseThree">
                                    Posso financiar uma viatura?
                                </button>
                            </h3>

                            <div id="faqCollapseThree" class="accordion-collapse collapse"
                                aria-labelledby="faqThree" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Sim. A UrbanMotors pode apresentar soluções de financiamento adequadas ao perfil
                                    e às necessidades do cliente.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h3 class="accordion-header" id="faqFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faqCollapseFour" aria-expanded="false"
                                    aria-controls="faqCollapseFour">
                                    Como sei se uma viatura ainda está disponível?
                                </button>
                            </h3>

                            <div id="faqCollapseFour" class="accordion-collapse collapse"
                                aria-labelledby="faqFour" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    O catálogo apresenta apenas viaturas disponíveis para consulta pública.
                                    Em caso de dúvida, pode confirmar a disponibilidade através da página de contactos.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h3 class="accordion-header" id="faqFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faqCollapseFive" aria-expanded="false"
                                    aria-controls="faqCollapseFive">
                                    Posso agendar uma visita ao stand?
                                </button>
                            </h3>

                            <div id="faqCollapseFive" class="accordion-collapse collapse"
                                aria-labelledby="faqFive" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Sim. Pode contactar a UrbanMotors por telefone, email ou formulário para agendar
                                    uma visita e conhecer a viatura presencialmente.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h3 class="accordion-header" id="faqSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faqCollapseSix" aria-expanded="false"
                                    aria-controls="faqCollapseSix">
                                    A UrbanMotors aceita retomas?
                                </button>
                            </h3>

                            <div id="faqCollapseSix" class="accordion-collapse collapse"
                                aria-labelledby="faqSix" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Sim. A aceitação de retomas está sujeita a avaliação da viatura e às condições
                                    comerciais acordadas com o cliente.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-5">
                        <h2 class="h4 fw-bold mb-3">
                            Ainda tem dúvidas?
                        </h2>

                        <p class="section-text mb-4" style="margin: auto">
                            Entre em contacto connosco para receber apoio personalizado.
                        </p>

                        <a href="{{ route('contactos.index') }}" class="btn btn-primary">
                            Contactar UrbanMotors
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
