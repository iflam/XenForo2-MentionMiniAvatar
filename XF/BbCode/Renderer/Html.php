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
			$user = \XF::app()->em()->find('XF:User', $userId);
		}

		$removeAt = \XF::options()->lw_mentionMiniAvatar_removeAt;

		if (!$user)
		{
			if ($removeAt == 'all')
			{
				$html = preg_replace('/(<a.*>)(@)?(.*<\/a>)/', '$1$3', $html);
			}

			return $html;
		}

		$avatarHtml = $this->templater->fn('avatar', [
			$user, // user
			's', // size
			false, // canonical
			['class' => 'mentionAvatar', 'notooltip' => true, 'href' => false] // attributes
		]);

		switch ($removeAt)
		{
			case 'disabled':
				$regexReplacement = '$1' . $avatarHtml . '$2$3';
				break;
			case 'with_avatar': // If we get here, we have an avatar.
			case 'all':
				$regexReplacement = '$1' . $avatarHtml . '$3';

				break;
			default:
				throw new \RuntimeException("Remove mention '@' character: Invalid option value encountered.");
		}

		$html = preg_replace('/(<a.*>)(@)?(.*<\/a>)/', $regexReplacement, $html);

		return $html;
	}
}