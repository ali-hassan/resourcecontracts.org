<?php

/*
|--------------------------------------------------------------------------
| Annotations List
|--------------------------------------------------------------------------
|
*/

return [
    'tags'                => [
        "Country",
        "Local-Company-Name",
        "Legal-Enterprise-Identifier",
        "Corporate-headquarters",
        "Company-structure",
        "Parent-companies-or-affilates",
        "Company-website",
        "Type-of-document",
        "Project-title",
        "Name/number-of-field-block-or-deposit",
        "Location-longitude-and-latitude",
        "Closest-community",
        "Date-of-issue-of-title/permit",
        "Date-of-ratification",
        "Stabilization-clause",
        "Arbitration-and-dispute-resolution"
    ],
    "annotation_category" => [
        'i-general-information'                                                                                                           => 'I. General information',
        'country'                                                                                                                         => 'Country',
        'name-of-company-executing-document'                                                                                              => 'Name of company executing document',
        'legal-enterprise-identifier'                                                                                                     => 'Legal Enterprise Identifier',
        'corporate-headquarters'                                                                                                          => 'Corporate headquarters ',
        'company-structure'                                                                                                               => 'Company structure',
        'parent-company-or-affiliates-outside-of-country'                                                                                 => 'Parent company or affiliates outside of country',
        'company-website'                                                                                                                 => 'Company website',
        'type-of-contract'                                                                                                                => 'Type of contract',
        'project-title'                                                                                                                   => 'Project title',
        'name-of-field-block-deposit-or-site'                                                                                             => 'Name of field, block, deposit or site',
        'location'                                                                                                                        => 'Location',
        'closest-community'                                                                                                               => 'Closest community',
        'date-of-issue-of-titlepermit'                                                                                                    => 'Date of issue of title/permit',
        'year-of-issue-of-titlepermit'                                                                                                    => 'Year of issue of title/permit',
        'date-of-ratification'                                                                                                            => 'Date of ratification',
        'other-general'                                                                                                                   => 'Other - general',
        'ii-summary-of-terms'                                                                                                             => 'II. Summary of terms',
        '1-fundamental-provisions'                                                                                                        => '1. Fundamental provisions',
        'signatories-company'                                                                                                             => 'Signatories, company',
        'state-agency-national-company-or-ministry-executing-the-document'                                                                => 'State agency, national company or ministry executing the document',
        'signatories-state'                                                                                                               => 'Signatories, State',
        'name-andor-composition-of-the-company-created'                                                                                   => 'Name and/or composition of the company created',
        'date-contract-signature'                                                                                                         => 'Date - contract signature',
        'year-of-contract-signature'                                                                                                      => 'Year of contract signature',
        'term'                                                                                                                            => 'Term',
        'renewal-or-extension-of-term'                                                                                                    => 'Renewal or extension of term',
        'resources'                                                                                                                       => 'Resource(s)',
        'size-of-concession-area'                                                                                                         => 'Size of concession area',
        '2-community-and-social-obligations'                                                                                              => '2. Community and social obligations',
        'local-development-agreement'                                                                                                     => 'Local development agreement',
        'sacred-cultural-or-historical-sites'                                                                                             => 'Sacred, cultural, or historical sites',
        'community-consultation'                                                                                                          => 'Community consultation',
        'training'                                                                                                                        => 'Training',
        'local-employment'                                                                                                                => 'Local employment',
        'local-procurement'                                                                                                               => 'Local procurement',
        'resettlement'                                                                                                                    => 'Resettlement',
        'outgrowers-program'                                                                                                              => 'Outgrowers Program',
        'protections-or-benefits-for-employees-dependents-or-others'                                                                      => 'Protections or benefits for employees, dependents, or others',
        'physical-security-or-protection-of-property'                                                                                     => 'Physical security or protection of property',
        'grievance-mechanisms'                                                                                                            => 'Grievance mechanisms',
        'right-to-access-concession-area-non-contracting-parties'                                                                         => 'Right to access concession area (non-contracting parties)',
        '3-developers-financial-obligations'                                                                                              => '3. Developers financial obligations',
        'royalties'                                                                                                                       => 'Royalties',
        'income-tax-rate'                                                                                                                 => 'Income tax: rate',
        'income-tax-exemptions'                                                                                                           => 'Income tax: exemptions',
        'income-tax-other'                                                                                                                => 'Income tax: other',
        'production-share-cost-oil-features-basis-of-calculation-limits-on-cost-recovery-eg-as-of-revenue-or-production-capex-uplift-etc' => 'Production Share - Cost Oil features  (basis of calculation, limits on cost recovery - e.g. as % of revenue or production, capex uplift, etc.)',
        'production-share-profit-oil-features-triggers-for-variations-in-split-irr-factor-production-etc'                                 => 'Production Share - "Profit Oil features  (triggers for variations in split - IRR, factor, production, etc.)',
        'service-agreement-fee-to-developer-or-contractor'                                                                                => 'Service Agreement - Fee to developer or contractor',
        'capital-gains-tax'                                                                                                               => 'Capital gains tax',
        'withholding-tax'                                                                                                                 => 'Withholding tax',
        'provisions-for-renewing-reserves'                                                                                                => 'Provisions for renewing reserves',
        'investment-credit'                                                                                                               => 'Investment credit',
        'custom-duties'                                                                                                                   => 'Custom duties',
        'social-security-contributions-by-employer'                                                                                       => 'Social security contributions by employer',
        'surface-fees-or-rent'                                                                                                            => 'Surface fees or rent',
        'financial-obligations-community-or-commodity-funds'                                                                              => 'Financial obligations - community or commodity funds',
        'carbon-credits'                                                                                                                  => 'Carbon credits',
        'bonuses'                                                                                                                         => 'Bonuses',
        'state-participation'                                                                                                             => 'State participation',
        'audit-mechanisms-financial-obligations'                                                                                          => 'Audit mechanisms - financial obligations',
        'restrictions-on-transactions-with-affiliated-parties'                                                                            => 'Restrictions on transactions with affiliated parties',
        'other-financialfiscal'                                                                                                           => 'Other - financial/fiscal',
        '4-environmental-provisions'                                                                                                      => '4. Environmental provisions',
        'environmental-impact-assessment-and-management-plan'                                                                             => 'Environmental impact assessment and management plan',
        'environmental-monitoring'                                                                                                        => 'Environmental monitoring',
        'socialhuman-rights-impact-assessment-and-management-plan'                                                                        => 'Social/human rights impact assessment and management plan',
        'socialhuman-rights-monitoring'                                                                                                   => 'Social/human rights monitoring',
        'water-use'                                                                                                                       => 'Water use',
        'environmental-protections'                                                                                                       => 'Environmental protections',
        '5-operational-provisions'                                                                                                        => '5. Operational provisions',
        'work-and-investment-commitments'                                                                                                 => 'Work and investment commitments',
        'transfer-of-risk'                                                                                                                => 'Transfer of risk',
        'infrastructure'                                                                                                                  => 'Infrastructure',
        'infrastructure-third-party-use'                                                                                                  => 'Infrastructure - third party use',
        'value-addition-or-downstream-activities'                                                                                         => 'Value addition or downstream activities',
        'land-use-outside-of-concession-area'                                                                                             => 'Land use outside of concession area',
        'other-operational'                                                                                                               => 'Other - operational',
        '6-miscellaneous-provisions'                                                                                                      => '6. Miscellaneous provisions',
        'governing-law'                                                                                                                   => 'Governing law',
        'arbitration-and-dispute-resolution'                                                                                              => 'Arbitration and dispute resolution',
        'stabilization-clause'                                                                                                            => 'Stabilization clause',
        'assignment-or-transfer'                                                                                                          => 'Assignment or transfer',
        'cancellation-or-termination'                                                                                                     => 'Cancellation or termination',
        'confidentiality'                                                                                                                 => 'Confidentiality',
        'language'                                                                                                                        => 'Language',
        'reporting-requirements'                                                                                                          => 'Reporting requirements',
        'hardship-clause-or-force-majeure'                                                                                                => 'Hardship clause or force majeure',
        'expropriation-or-nationalization'                                                                                                => 'Expropriation or nationalization',
        'other-miscellaneous'                                                                                                             => 'Other - miscellaneous',
        'iii-document-notes'                                                                                                              => 'III. Document notes',
        'pages-missing-from-copy'                                                                                                         => 'Pages missing from  copy',
        'annexes-missing-from-copy'                                                                                                       => 'Annexes missing from copy'
    ]
];