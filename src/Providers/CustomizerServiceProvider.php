<?php
namespace App\Providers;

use Kirki;

class CustomizerServiceProvider
{
	protected $sections = [
		'company'       => [
			'title'          => 'Algemene informatie',
			'description'    => 'Deze informatie wordt op meerdere plekken in het Thema gebruikt',
			'panel'          => 'general',
			'priority'       => 160,
		],
		'functions'     => [
			'title'         => 'Thema functies',
			'description'   => 'Hier kan je enkele functies van het thema aan en uit zetten',
			'panel'         => 'general',
			'priority'      => 160
		],
		'owner'         => [
			'title'         => 'Gemaakt door informatie',
			'description'   => 'Deze informatie van de eigenaar gebruikt het thema',
			'panel'         => 'general',
			'priority'      => 80
		]
	];
	
	public function __construct() {
		$this->initKirki();
		$this->addPanels();
		$this->addSections();
		$this->boot();
	}
	
	protected function boot(): void
	{
		$this->addCompanyFields();
		$this->addFunctionFields();
		$this->addOwnerFields();
	}
	
	private function addCompanyFields(): void
	{
		Kirki::add_field(
			'postw',
			[
				'type'          => 'text',
				'settings'      => 'phonenumber',
				'label'         => esc_html__( 'Telefoonnummer', 'pstw' ),
				'description'   => esc_html__('Dit telefoonnummer gebruikt het thema op meerdere plekken'),
				'section'       => 'company',
				'default'       => esc_html__( '+31 20 123456789', 'pstw' ),
				'priority'      => 10,
			]
		);
		
		Kirki::add_field('postw',
			[
				'type'          => 'text',
				'settings'      => 'emailaddress',
				'label'         => esc_html('E-mailadres'),
				'description'   => esc_html('Dit is het standaard emailadres'),
				'section'       => 'company',
				'default'       => get_option('admin_email')
			]
		);
		
		Kirki::add_field(
			'postw',
			[
				'type'          => 'text',
				'settings'      => 'address',
				'label'         => esc_html('Straat en Huisnummer'),
				'section'       => 'company',
			]
		);
		
		Kirki::add_field(
			'postw',
			[
				'type'          => 'text',
				'settings'      => 'postalcode',
				'label'         => esc_html('Postcode'),
				'section'       => 'company',
			]
		);
		
		Kirki::add_field(
			'postw',
			[
				'type'          => 'text',
				'settings'      => 'city',
				'label'         => esc_html('Stad'),
				'section'       => 'company',
			]
		);
		
		Kirki::add_field(
			'postw',
			[
				'type'          => 'text',
				'settings'      => 'country',
				'label'         => esc_html('Land'),
				'section'       => 'company',
			]
		);
	}
	
	private function addFunctionFields(): void
	{
		Kirki::add_field(
			'postw',
			[
				'type'      => 'toggle',
				'settings'  => 'std-organisation',
				'label'     => esc_html('Schema voor bedrijf aanzetten?'),
				'section'   => 'functions',
			]
		);
	}
	
	private function addOwnerFields(): void
	{
		Kirki::add_field(
			'postw',
			[
				'type'      => 'toggle',
				'settings'  => 'attribution-link',
				'label'     => esc_html('Attributie link'),
				'section'   => 'owner',
			]
		);
		Kirki::add_field(
			'postw',
			[
				'type'      => 'text',
				'settings'  => 'attribution-title',
				'label'     => esc_html('Attributie titel'),
				'section'   => 'owner',
			]
		);
		Kirki::add_field(
			'postw',
			[
				'type'      => 'editor',
				'settings'  => 'attribution-payoff',
				'label'     => esc_html('Attributie text'),
				'section'   => 'owner',
			]
		);
		Kirki::add_field(
			'postw',
			[
				'type'      => 'image',
				'settings'  => 'attribution-logo',
				'label'     => esc_html('Attributie logo'),
				'section'   => 'owner',
				'choices'     => [
					'save_as' => 'id',
				]
			]
		);
	}
	
	private function initKirki(): void
	{
		Kirki::add_config( 'postw', [
			'capability'    => 'edit_theme_options',
			'option_type'   => 'theme_mod',
		] );
	}
	
	private function addSections(): void
	{
		foreach ($this->sections as $id => $section) {
			Kirki::add_section( $id, [
				'title'          => esc_html__($section['title'], 'pstw'),
				'description'    => esc_html__($section['description'], 'pstw'),
				'panel'          => $section['panel'],
				'priority'       => $section['priority'],
			]);
		}
	}
	
	private function addPanels()
	{
		Kirki::add_panel('general',
			[
				'priority'      => 10,
				'title'         => 'Algemene informatie',
				'description'   => 'De algemene informatie voor Postwijnen'
			]
		);
	}
}
