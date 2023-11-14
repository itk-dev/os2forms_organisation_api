<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231114120825 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
            CREATE OR REPLACE VIEW funktions_data AS
                SELECT
                    organisation_funktion_registrering.organisation_funktion_id AS id,
                    organisation_funktion_registrering_egenskab.funktion_navn AS funktionsnavn,
                    organisation_enhed_registrering_egenskab.enhed_navn AS enhedsnavn,
                    adresse_registrering_egenskab.adresse_tekst AS adresse
                FROM organisation_funktion_registrering
                JOIN organisation_funktion_registrering_egenskab ON organisation_funktion_registrering.id = organisation_funktion_registrering_egenskab.organisation_funktion_registrering_id
                JOIN organisation_funktion_registrering_tilknyttede_enheder ON organisation_funktion_registrering.id = organisation_funktion_registrering_tilknyttede_enheder.organisation_funktion_registrering_id
                JOIN organisation_enhed_registrering ON organisation_funktion_registrering_tilknyttede_enheder.reference_id_uuididentifikator = organisation_enhed_registrering.organisation_enhed_id
                JOIN organisation_enhed_registrering_egenskab ON organisation_enhed_registrering.id = organisation_enhed_registrering_egenskab.organisation_enhed_registrering_id
                
                LEFT OUTER JOIN organisation_enhed_registrering_adresser ON organisation_enhed_registrering.id = organisation_enhed_registrering_adresser.organisation_enhed_registrering_id
                    AND organisation_enhed_registrering_adresser.rolle_label = 'Postadresse'
                LEFT OUTER JOIN adresse_registrering ON organisation_enhed_registrering_adresser.reference_id_uuididentifikator = adresse_registrering.adresse_id
                LEFT OUTER JOIN adresse_registrering_egenskab ON adresse_registrering.id = adresse_registrering_egenskab.adresse_registrering_id
            ;"
        );

    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP VIEW funktions_data');
    }
}
