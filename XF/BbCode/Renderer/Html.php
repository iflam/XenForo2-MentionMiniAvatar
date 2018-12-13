<?php

namespace LiamW\MentionMiniAvatar\XF\BbCode\Renderer;

class Html extends XFCP_Html
{
	public function renderTagUser(array $children, $option, array $tag, array $options)
	{
		$html = parent::renderTagUser($children, $option, $tag, $options);

		if ($html === '')
		{
			return $html;
		}

		$userId = intval($option);

		$user = null;

		if (isset($options['lwMentionedUsers'][$userId]))
		{
			$user = $options['lwMentionedUsers'][$userId];
		}
		else if (\XF::options()->lw_mentionMiniAvatar_fetchLegacy == 'cached')
		{
			$user = \XF::app()->em()->findCached('XF:User', $userId);
		}
		else if (\XF::options()->lw_mentionMiniAvatar_fetchLegacy == 'always')
		{
			// This method will check the cache before querying, so prefer it to using a finder.
			$user = \XF::app()->em()->find('XF:User', $userId);
		}

		if (!$user)
		{
			return $html;
		}

		$avatarHtml = $this->templater->fn('avatar', [
			$user, // user
			's', // size
			false, // canonical
			['class' => 'mentionAvatar', 'notooltip' => true, 'href' => false] // attributes
		]);

		$html = preg_replace('/(<a.*>)(.*)(<\/a>)/', '$1' . $avatarHtml . '$2$3', $html);

		return $html;
	}
}