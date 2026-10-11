<?php
use CRM_Wpcvquicksearch_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_WPCV_Quick_Search',
    'entity' => 'SavedSearch',
    'cleanup' => 'unused',
    'update' => 'unmodified',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'WPCV_Quick_Search',
        'label' => E::ts('WPCV Quick Search'),
        'api_entity' => 'Contact',
        'api_params' => [
          'version' => 4,
          'select' => [
            'id',
            'display_name',
            'sort_name',
            'contact_type:label',
            'contact_sub_type:label',
            'address_primary.state_province_id:label',
            'email_primary.email',
          ],
          'orderBy' => [],
          'where' => [
            ['is_deleted', '=', FALSE],
          ],
          'groupBy' => [],
          'join' => [],
          'having' => [],
        ],
      ],
      'match' => ['name'],
    ],
  ],
  [
    'name' => 'SavedSearch_WPCV_Quick_Search_SearchDisplay_WPCV_Quick_Search_Autocomplete',
    'entity' => 'SearchDisplay',
    'cleanup' => 'unused',
    'update' => 'unmodified',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'WPCV_Quick_Search_Autocomplete',
        'label' => E::ts('WPCV Quick Search'),
        'saved_search_id.name' => 'WPCV_Quick_Search',
        'type' => 'autocomplete',
        'settings' => [
          'sort' => [
            ['sort_name', 'ASC'],
          ],
          'columns' => [
            [
              'type' => 'field',
              'key' => 'display_name',
              'icons' => [
                [
                  'field' => 'contact_type:icon',
                  'side' => 'left',
                ],
              ],
              'rewrite' => '[display_name]',
            ],
            [
              'type' => 'field',
              'key' => 'email_primary.email',
              'rewrite' => '{if !strstr(\'[display_name]\', \'@\') && \'[email_primary.email]\' != \'\'}
[email_primary.email]{if \'[address_primary.state_province_id:label]\' != \'\'} · {/if}
{/if}
[address_primary.state_province_id:label]',
            ],
          ],
          'searchFields' => ['id', 'display_name', 'sort_name'],
        ],
      ],
      'match' => [
        'saved_search_id',
        'name',
      ],
    ],
  ],
];
