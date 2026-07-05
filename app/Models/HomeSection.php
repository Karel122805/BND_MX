<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HomeSection extends Model
{
    protected $fillable = [
        'title',

        'title_part_1',
        'title_part_1_color_id',
        'title_part_2',
        'title_part_2_color_id',
        'title_part_3',
        'title_part_3_color_id',

        'subtitle',
        'subtitle_text_color_id',
        'subtitle_border_color_id',
        'subtitle_background_color_id',
        'subtitle_background_opacity',

        'content',

        'image',
        'use_secondary_image',

        'background_media_asset_id',
        'background_opacity',

        'text_color_id',
        'button_color_id',
        'accent_color_id',
        'tertiary_color_id',

        'sort_order',
        'is_active',

        'stat_1_number',
        'stat_1_label',
        'stat_1_color_id',
        'stat_1_label_color_id',

        'stat_2_number',
        'stat_2_label',
        'stat_2_color_id',
        'stat_2_label_color_id',

        'stat_3_number',
        'stat_3_label',
        'stat_3_color_id',
        'stat_3_label_color_id',

        'stat_4_number',
        'stat_4_label',
        'stat_4_color_id',
        'stat_4_label_color_id',

        'primary_button_text',
        'primary_button_url',
        'primary_button_color_id',
        'primary_button_opacity',
        'primary_button_radius',
        'primary_button_text_color_id',
        'primary_button_hover_color_id',
        'primary_button_hover_text_color_id',
        'primary_button_icon',
        'primary_button_icon_color_id',
        'primary_button_hover_icon_color_id',

        'secondary_button_text',
        'secondary_button_url',
        'secondary_button_color_id',
        'secondary_button_opacity',
        'secondary_button_radius',
        'secondary_button_text_color_id',
        'secondary_button_hover_color_id',
        'secondary_button_hover_text_color_id',
        'secondary_button_icon',
        'secondary_button_icon_color_id',
        'secondary_button_hover_icon_color_id',

        // Bloque: ¿Qué hacemos?
        'what_we_do_label',
        'what_we_do_label_color_id',
        'what_we_do_background_color_id',
        'what_we_do_use_gradient',
        'what_we_do_gradient_from_color_id',
        'what_we_do_gradient_to_color_id',
        'what_we_do_title',
        'what_we_do_title_color_id',
        'what_we_do_content',
        'what_we_do_content_color_id',

        // Tarjeta 1
        'what_card_1_title',
        'what_card_1_content',
        'what_card_1_icon',
        'what_card_1_button_text',
        'what_card_1_button_url',
        'what_card_1_background_color_id',
        'what_card_1_title_color_id',
        'what_card_1_content_color_id',
        'what_card_1_icon_color_id',
        'what_card_1_icon_background_color_id',
        'what_card_1_link_color_id',

        // Tarjeta 2
        'what_card_2_title',
        'what_card_2_content',
        'what_card_2_icon',
        'what_card_2_button_text',
        'what_card_2_button_url',
        'what_card_2_background_color_id',
        'what_card_2_title_color_id',
        'what_card_2_content_color_id',
        'what_card_2_icon_color_id',
        'what_card_2_icon_background_color_id',
        'what_card_2_link_color_id',

        // Tarjeta 3
        'what_card_3_title',
        'what_card_3_content',
        'what_card_3_icon',
        'what_card_3_button_text',
        'what_card_3_button_url',
        'what_card_3_background_color_id',
        'what_card_3_title_color_id',
        'what_card_3_content_color_id',
        'what_card_3_icon_color_id',
        'what_card_3_icon_background_color_id',
        'what_card_3_link_color_id',

        // Cierre corto de contacto
        'contact_cta_title',
        'contact_cta_content',
        'contact_cta_button_text',
        'contact_cta_button_url',
        'contact_cta_background_color_id',
        'contact_cta_gradient_from_color_id',
        'contact_cta_gradient_to_color_id',
        'contact_cta_use_gradient',
        'contact_cta_title_color_id',
        'contact_cta_content_color_id',
        'contact_cta_button_color_id',
        'contact_cta_button_text_color_id',
        'contact_cta_button_icon',
        'contact_cta_button_icon_color_id',
        'contact_cta_button_hover_color_id',
        'contact_cta_button_hover_text_color_id',
        'contact_cta_button_hover_icon_color_id',
        'contact_cta_button_radius',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'use_secondary_image' => 'boolean',

        'sort_order' => 'integer',
        'background_opacity' => 'integer',
        'subtitle_background_opacity' => 'integer',

        'stat_1_number' => 'integer',
        'stat_2_number' => 'integer',
        'stat_3_number' => 'integer',
        'stat_4_number' => 'integer',

        'primary_button_opacity' => 'integer',
        'secondary_button_opacity' => 'integer',

        'primary_button_radius' => 'integer',
        'secondary_button_radius' => 'integer',

        'what_we_do_use_gradient' => 'boolean',

        'contact_cta_use_gradient' => 'boolean',
        'contact_cta_button_radius' => 'integer',
    ];

    public function backgroundMediaAsset(): BelongsTo
    {
        return $this->belongsTo(MediaAsset::class, 'background_media_asset_id');
    }

    public function textColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'text_color_id');
    }

    public function buttonColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'button_color_id');
    }

    public function accentColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'accent_color_id');
    }

    public function tertiaryColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'tertiary_color_id');
    }

    public function titlePart1Color(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'title_part_1_color_id');
    }

    public function titlePart2Color(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'title_part_2_color_id');
    }

    public function titlePart3Color(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'title_part_3_color_id');
    }

    public function subtitleTextColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'subtitle_text_color_id');
    }

    public function subtitleBorderColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'subtitle_border_color_id');
    }

    public function subtitleBackgroundColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'subtitle_background_color_id');
    }

    public function stat1Color(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'stat_1_color_id');
    }

    public function stat2Color(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'stat_2_color_id');
    }

    public function stat3Color(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'stat_3_color_id');
    }

    public function stat4Color(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'stat_4_color_id');
    }


    public function stat1LabelColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'stat_1_label_color_id');
    }

    public function stat2LabelColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'stat_2_label_color_id');
    }

    public function stat3LabelColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'stat_3_label_color_id');
    }

    public function stat4LabelColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'stat_4_label_color_id');
    }

    public function primaryButtonColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'primary_button_color_id');
    }

    public function primaryButtonTextColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'primary_button_text_color_id');
    }

    public function primaryButtonHoverColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'primary_button_hover_color_id');
    }

    public function primaryButtonHoverTextColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'primary_button_hover_text_color_id');
    }

    public function primaryButtonIconColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'primary_button_icon_color_id');
    }

    public function primaryButtonHoverIconColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'primary_button_hover_icon_color_id');
    }

    public function secondaryButtonColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'secondary_button_color_id');
    }

    public function secondaryButtonTextColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'secondary_button_text_color_id');
    }

    public function secondaryButtonHoverColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'secondary_button_hover_color_id');
    }

    public function secondaryButtonHoverTextColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'secondary_button_hover_text_color_id');
    }

    public function secondaryButtonIconColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'secondary_button_icon_color_id');
    }

    public function secondaryButtonHoverIconColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'secondary_button_hover_icon_color_id');
    }


    public function whatWeDoBackgroundColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'what_we_do_background_color_id');
    }

    public function whatWeDoGradientFromColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'what_we_do_gradient_from_color_id');
    }

    public function whatWeDoGradientToColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'what_we_do_gradient_to_color_id');
    }

    public function whatWeDoLabelColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'what_we_do_label_color_id');
    }

    public function whatWeDoTitleColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'what_we_do_title_color_id');
    }

    public function whatWeDoContentColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'what_we_do_content_color_id');
    }

    public function whatCard1BackgroundColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'what_card_1_background_color_id');
    }

    public function whatCard1TitleColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'what_card_1_title_color_id');
    }

    public function whatCard1ContentColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'what_card_1_content_color_id');
    }

    public function whatCard1IconColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'what_card_1_icon_color_id');
    }

    public function whatCard1IconBackgroundColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'what_card_1_icon_background_color_id');
    }

    public function whatCard1LinkColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'what_card_1_link_color_id');
    }

    public function whatCard2BackgroundColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'what_card_2_background_color_id');
    }

    public function whatCard2TitleColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'what_card_2_title_color_id');
    }

    public function whatCard2ContentColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'what_card_2_content_color_id');
    }

    public function whatCard2IconColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'what_card_2_icon_color_id');
    }

    public function whatCard2IconBackgroundColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'what_card_2_icon_background_color_id');
    }

    public function whatCard2LinkColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'what_card_2_link_color_id');
    }

    public function whatCard3BackgroundColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'what_card_3_background_color_id');
    }

    public function whatCard3TitleColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'what_card_3_title_color_id');
    }

    public function whatCard3ContentColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'what_card_3_content_color_id');
    }

    public function whatCard3IconColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'what_card_3_icon_color_id');
    }

    public function whatCard3IconBackgroundColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'what_card_3_icon_background_color_id');
    }

    public function whatCard3LinkColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'what_card_3_link_color_id');
    }

    public function contactCtaBackgroundColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'contact_cta_background_color_id');
    }

    public function contactCtaGradientFromColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'contact_cta_gradient_from_color_id');
    }

    public function contactCtaGradientToColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'contact_cta_gradient_to_color_id');
    }

    public function contactCtaTitleColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'contact_cta_title_color_id');
    }

    public function contactCtaContentColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'contact_cta_content_color_id');
    }

    public function contactCtaButtonColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'contact_cta_button_color_id');
    }

    public function contactCtaButtonTextColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'contact_cta_button_text_color_id');
    }

    public function contactCtaButtonIconColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'contact_cta_button_icon_color_id');
    }

    public function contactCtaButtonHoverColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'contact_cta_button_hover_color_id');
    }

    public function contactCtaButtonHoverTextColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'contact_cta_button_hover_text_color_id');
    }

    public function contactCtaButtonHoverIconColor(): BelongsTo
    {
        return $this->belongsTo(ThemeColor::class, 'contact_cta_button_hover_icon_color_id');
    }
}