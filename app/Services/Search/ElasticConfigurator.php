<?php

namespace App\Services\Search;

class ElasticConfigurator
{
    public function getConfigs(string $index): array
    {
        return [
            'index' => $index,
            'body'  => [
                'settings' => [
                    'analysis' => [
                        'filter'      => [
                            'shingle'               => [
                                'type' => 'shingle',
                            ],
                            'russian_stop'          => [
                                'type'      => 'stop',
                                'stopwords' => '_russian_',

                            ],
                            'russian_stemmer'       => [
                                'type'     => 'stemmer',
                                'language' => 'russian'
                            ],
                            'english_stemmer'       => [
                                'type'     => 'stemmer',
                                'language' => 'english'
                            ],
                            'my_phonetic_cyrillic'  => [
                                'type'        => 'phonetic',
                                'encoder'     => 'beider_morse',
                                'rule_type'   => 'approx',
                                'name_type'   => 'generic',
                                'languageset' => ['cyrillic']
                            ],
                            'my_phonetic_english'   => [
                                'type'        => 'phonetic',
                                'encoder'     => 'beider_morse',
                                'rule_type'   => 'approx',
                                'name_type'   => 'generic',
                                'languageset' => ['english']
                            ],
                            'mynGram'               => [
                                'type'     => 'edge_ngram',
                                'min_gram' => 3,
                                'max_gram' => 15
                            ],
                            'search_mynGram'        => [
                                'type'     => 'edge_ngram',
                                'min_gram' => 2,
                                'max_gram' => 15
                            ],
                            'length_filter'         => [
                                'type' => 'length',
                                'min'  => 2
                            ],
                            'unique_token_position' => [
                                'type'                  => 'unique',
                                'only_on_same_position' => true
                            ]
                        ],
                        'char_filter' => [
                            'html_strip',
                            'keyboard_filter' => [
                                'type'     => 'mapping',
                                'mappings' => $this->getKeyboard(),
                            ],
                        ],
                        'analyzer'    => [
                            'name_index_analyzer_ru'                => [
                                'type'        => 'custom',
                                'tokenizer'   => 'standard',
                                'filter'      => [
                                    'mynGram',
                                    'lowercase',
                                    'shingle',
                                    'russian_stop',
                                    'russian_stemmer',
                                    'porter_stem',
                                    'trim',
                                ],
                                'char_filter' => ['html_strip']
                            ],
                            'title_index_analyzer_en'               => [
                                'type'        => 'custom',
                                'tokenizer'   => 'standard',
                                'filter'      => [
                                    'mynGram',
                                    'lowercase',
                                    'shingle',
                                    'stop',
                                    'english_stemmer',
                                    'porter_stem',
                                    'trim',
                                ],
                                'char_filter' => ['html_strip']
                            ],
                            'big_text_analyzer'                     => [
                                'type'      => 'custom',
                                'tokenizer' => 'standard',
                                'filter'    => ['lowercase', 'shingle', 'asciifolding', 'russian_stop', 'russian_stemmer', 'length_filter', 'trim', 'unique_token_position']
                            ],
                            'big_text_analyzer_en'                  => [
                                'type'      => 'custom',
                                'tokenizer' => 'standard',
                                'filter'    => ['lowercase', 'shingle', 'asciifolding', 'stop', 'english_stemmer', 'length_filter', 'trim', 'unique_token_position']
                            ],
                            'keywords_analyzer'                     => [
                                'type'      => 'custom',
                                'tokenizer' => 'comma_tokenizer',
                                'filter'    => ['lowercase', 'mynGram', 'trim', 'unique']
                            ],
                            'analyzer_search_ru'                    => [
                                'tokenizer' => 'standard',
                                'filter'    => [
                                    'mynGram',
                                    'lowercase',
                                    'shingle',
                                    'stop',
                                    'russian_stemmer',
                                    'porter_stem',
                                    'trim',
                                ],
                            ],
                            'analyzer_search_en'                    => [
                                'tokenizer' => 'keyword',
                                'filter'    => [
                                    'mynGram',
                                    'lowercase',
                                    'shingle',
                                    'stop',
                                    'english_stemmer',
                                    'porter_stem',
                                    'trim',
                                ],
                            ],
                            'search_keywords_analyzer'              => [
                                'type'      => 'custom',
                                'tokenizer' => 'comma_tokenizer',
                                'filter'    => ['lowercase', 'search_mynGram', 'trim', 'unique']
                            ],
                            'analyzer_search_translit'              => [
                                'tokenizer' => 'standard',
                                'filter'    => [
                                    'mynGram',
                                    'lowercase',
                                    'shingle',
                                    'stop',
                                    'english_stemmer',
                                    'porter_stem',
                                    'trim',
                                    'my_phonetic_cyrillic',
                                    'my_phonetic_english'
                                ],
                            ],
                            'analyzer_search_keyboard'              => [
                                'tokenizer'   => 'keyword',
                                'filter'      => [
                                    'mynGram',
                                    'lowercase',
                                    'shingle',
                                    'stop',
                                    'trim',
                                ],
                                'char_filter' => [
                                    'keyboard_filter'
                                ]
                            ],
                            'analyzer_search_autocomplete'          => [
                                'tokenizer' => 'keyword',
                                'filter'    => [
                                    'mynGram',
                                    'lowercase',
                                    'shingle',
                                    'stop',
                                    'english_stemmer',
                                    'porter_stem',
                                    'trim',
                                ],
                            ],
                            'analyzer_search_autocomplete_keyboard' => [
                                'tokenizer'   => 'keyword',
                                'filter'      => [
                                    'mynGram',
                                    'lowercase',
                                    'shingle',
                                    'stop',
                                    'english_stemmer',
                                    'porter_stem',
                                    'trim',
                                ],
                                'char_filter' => [
                                    'keyboard_filter'
                                ]
                            ],
                        ],
                        'tokenizer'   => [
                            'comma_tokenizer' => [
                                'type'    => 'pattern',
                                'pattern' => ','
                            ]
                        ],
                    ]
                ],
                'mappings' => [
                    'properties' => $this->mappingProperties()
                ]
            ]
        ];
    }

    public function mappingProperties(): array
    {
        return [
            'name_uk'               => [
                'type'            => 'text',
                'analyzer'        => 'name_index_analyzer_ru',
                'copy_to'         => 'combined',
                'search_analyzer' => 'analyzer_search_ru',
            ],
            'name_ru'               => [
                'type'            => 'text',
                'analyzer'        => 'name_index_analyzer_ru',
                'copy_to'         => 'combined',
                'search_analyzer' => 'analyzer_search_ru',
            ],
            'translit'              => [
                'type'            => 'text',
                'analyzer'        => 'analyzer_search_translit',
                'copy_to'         => 'combined',
                'search_analyzer' => 'analyzer_search_translit',
            ],
            'description_uk'        => [
                'type'            => 'text',
                'analyzer'        => 'name_index_analyzer_ru',
                'copy_to'         => 'combined',
                'search_analyzer' => 'analyzer_search_ru',
            ],
            'description_ru'        => [
                'type'            => 'text',
                'analyzer'        => 'name_index_analyzer_ru',
                'copy_to'         => 'combined',
                'search_analyzer' => 'analyzer_search_ru',
            ],
            'domain'                => [
                'type' => 'keyword',
            ],
            'url'                   => [
                'type' => 'keyword',
            ],
            'title_autocomplete'    => [
                'type'            => 'completion',
                'analyzer'        => 'analyzer_search_autocomplete',
                'search_analyzer' => 'analyzer_search_autocomplete',
            ],
            'title_autocomplete_ru' => [
                'type'            => 'completion',
                'analyzer'        => 'analyzer_search_autocomplete',
                'search_analyzer' => 'analyzer_search_autocomplete',
            ],
            'title_autocomplete_en' => [
                'type' => 'completion',
            ]
        ];
    }

    public function getKeyboard(): array
    {
        return [
            'f => а', ', => б', 'd => в', 'u => г', 'l => д', 't => е', '` => ё',
            '; => ж', 'p => з', 'b => и', 'q => й', 'r => к', 'k => л', 'v => м',
            'y => н', 'j => о', 'g => п', 'h => р', 'c => с', 'n => т', 'e => у',
            'a => ф', '[ => х', 'w => ц', 'x => ч', 'i => ш', 'o => щ', 'm => ь',
            's => ы', '] => ъ', "' => э", '. => ю', 'z => я',

            'F => А', '< => Б', 'D => В', 'U => Г', 'L => Д', '~ => Ё',
            ': => Ж', 'P => З', 'B => И', 'Q => Й', 'R => К', 'K => Л', 'V => М',
            'Y => Н', 'J => О', 'G => П', 'H => Р', 'C => С', 'N => Т', 'E => У',
            'A => Ф', '{ => Х', 'W => Ц', 'X => Ч', 'I => Ш', 'O => Щ', 'M => Ь',
            'S' => 'Ы', '}' => 'Ъ', '"' => 'Э', '>' => 'Ю', 'Z' => 'Я',

            '@ => "', '# => №', '$ => ;', '^ => :', '& => ?', '/ => .', '? => ,',
        ];
    }
}